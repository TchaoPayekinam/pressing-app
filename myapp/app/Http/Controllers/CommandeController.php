<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vetement;
use App\Models\Commande;
use DB;
use PDF;

class CommandeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes_attente = Commande::where('statut',0)->get();
        $commandes_valide = Commande::where('statut',1)->get();
        return view('commandes.index',compact('commandes_attente','commandes_valide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vetements = Vetement::get();
        return view('commandes.create', compact('vetements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                
        $nombre = count($request->nombre);
        $n = 0;
        $verif_nombre = 0;
        while ($n < $nombre) {
            if (is_null($request->nombre[$n]) or is_null($request->date_livraison)) {
                $verif_nombre++;
            }
            $n++;
        }
        if ($verif_nombre!=0) {
            $message = [
                'status' => 'empty_commande'
            ];
            echo json_encode($message);
        }
        else {
            if (is_null($request->nom_client) or is_null($request->adresse_client) or is_null($request->tel_client)) {
                    $message = [
                        'status' => 'empty_user'
                    ];
                    echo json_encode($message);
            }
            else {
                $commande = new Commande;
                $commande->date_depot = date('Y-m-d');
                $commande->date_livraison = $request->date_livraison;
                $commande->remise = $request->remise;
                $commande->nom_client = $request->nom_client;
                //$commande->prenom_client = $request->prenom_client;
                $commande->adresse_client = $request->adresse_client;
                $commande->tel_client = $request->tel_client;
                if($request->express){
                    $commande->express = $request->express;
                }
                if (!is_null($request->frais_livraison)) {
                    $commande->frais_livraison = $request->frais_livraison;
                }
                if($request->adresse_livraison){
                    $commande->adresse_livraison = $request->adresse_livraison;
                }
                $commande->save();

                $id_commande = DB::table('commandes')->latest()->first();

                $i = 0;
                while ($i < $nombre) {

                    DB::table('details_commande')->insert(
                        [
                            'commande_id' => $id_commande->id,
                            'vetement_id' => $request->vetement[$i],
                            'nombre' => $request->nombre[$i],
                            'laver' => $request->laver[$i],
                            'repasser' => $request->repasser[$i],
                            'retoucher' => $request->retoucher[$i],
                        ]
                    );
                    $i++;
                }

                $message = [
                        'status' => 'true',
                        'redirect_url' => route('commandes.index'),
                ];
                echo json_encode($message);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$details_commande = DB::table('details_commande')->where('commande_id',$id)->get();
        $commande = Commande::where('id',$id)->first();
        return view('commandes.show',compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commande = Commande::where('id', $id)->first();
        $vetements = Vetement::get();
        return view('commandes.edit',compact('commande','vetements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nombre = count($request->nombre);
        $commande = Commande::find($id);
        $commande->date_livraison = $request->date_livraison;
        $commande->remise = $request->remise;
        $commande->nom_client = $request->nom_client;
        //$commande->prenom_client = $request->prenom_client;
        $commande->adresse_client = $request->adresse_client;
        $commande->tel_client = $request->tel_client;
        if (!is_null($request->frais_livraison)) {
            $commande->frais_livraison = $request->frais_livraison;
        }
        if($request->express){
            $commande->express = $request->express;
        } else {
            $commande->express = 0;
        }
        if($request->adresse_livraison){
            $commande->adresse_livraison = $request->adresse_livraison;
        }
        $commande->save();

        $i = 0;
        while ($i < $nombre) {
            DB::table('details_commande')
                ->where('id', $request->detail_commande_id[$i])
                ->update(
                    [
                        'commande_id' => $id,
                        'vetement_id' => $request->vetement[$i],
                        'nombre' => $request->nombre[$i],
                        'laver' => $request->laver[$i],
                        'repasser' => $request->repasser[$i],
                        'retoucher' => $request->retoucher[$i],
                    ]
                );
            $i++;
        }

        return redirect(route('commandes.index'))->with('message','Commande modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commande = Commande::find($id);
        $commande->delete();

        return back()->with('success', 'Commande supprimée avec succès !');
    }

    public function livrer($id)
    {
        $commande = Commande::find($id);
        $commande->statut = 1;

        $commande->save();
        return back()->with('message', 'Livraison effectuée avec succès !');
    }

    public function getPDF($id)
    {
        $facture = DB::table('factures')->where('commande_id',$id)->first();
        
        if(is_null($facture)) 
        {
            DB::table('factures')->insert(
                [
                    'commande_id' => $id,
                ]
            );
        }        

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('commandes.recu',compact('id'));
        return $pdf->download('reçu.pdf');
    }

    public function rapport_journalier(){
        $date_commande = date('Y-m-d');
        $commandes = Commande::where('date_depot', $date_commande)->get();
        return view('commandes.rapports.journalier', compact('commandes', 'date_commande'));
    }

    public function rapportJournalierStore(Request $request){
        $date_commande = $request->date;
        $commandes = Commande::where('date_depot',$date_commande)->get();
        return view('commandes.rapports.journalier', compact('commandes', 'date_commande'));
    }

    public function rapport_journalierPDF($date){
        $commandes = Commande::where('date_depot',$date)->get();
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('commandes.rapports.RapportJournalierPDF',compact('commandes','date'));
        return $pdf->download('RapportJournalier.pdf');
    }

    /* public function rapport_hebdomadaire(){
        return view('commandes.rapports.hebdomadaire');
    } */

    public function rapport_periodique(){
        return view('commandes.rapports.periodique');
    }

    public function rapport_periodiquePDF(Request $request){
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;
        $commandes = Commande::whereBetween('date_depot',[$request->date_debut,$request->date_fin])
                               ->orderBy('id', 'desc')
                               ->get();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('commandes.rapports.RapportPeriodiquePDF',compact('commandes','date_debut','date_fin'));
        return $pdf->download('RapportPeriodique.pdf');

    }

    public function express(){
        $commandes_attente = Commande::where('statut',0)->where('express',1)->get();
        $commandes_valide = Commande::where('statut',1)->where('express',1)->get();
        return view('commandes.express.index',compact('commandes_attente','commandes_valide'));
    }
}
