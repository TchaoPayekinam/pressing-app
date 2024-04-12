<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vetement;

class VetementController extends Controller
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
        $vetements = Vetement::orderByDesc('id')->get();
        return view('vetements.index', compact('vetements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        return view('vetements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'designation' => ['required', 'string', 'max:255'],
            'prix_lavage' => ['required'],
            'prix_repassage' => ['required'],
            'prix_retouche' => ['required'],
        ]);

        $vetement = Vetement::create($request->all());

        return redirect(route('vetements.index'))->with('message','Vêtement enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vetement = Vetement::where('id', $id)->first();
        return view('vetements.edit', compact('vetement'));
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
        $vetement = Vetement::find($id);
        $vetement->designation = $request->designation;
        $vetement->prix_lavage = $request->prix_lavage;
        $vetement->prix_retouche = $request->prix_retouche;
        $vetement->prix_repassage = $request->prix_repassage;

        $vetement->save();
        return redirect(route('vetements.index'))->with('message','Vêtement modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vetement = Vetement::find($id);
        $vetement->delete();

        return back()->with('message', 'Vêtement supprimé avec succès !');
    }
}
