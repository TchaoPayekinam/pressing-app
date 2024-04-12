<!DOCTYPE html>
<html>
<head>   
   <style type="text/css">
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5mm;
        }

        #table tr {
            background-color: white;
            color: black
        }

        #table tr th {
            border: 1px solid #aaa;
            /* width: 14%; */
            text-align: center;
            /padding: 15px/
        }

        #table tr td {
            border: 1px solid #aaa;
            /* width: 14%; */
            text-align: center;
            text-decoration: blink;
            /padding: 15px/
        }

        h2 {
            font: normal 175% Arial, Helvetica, sans-serif;
            color: #000000;
            letter-spacing: -1px;
            margin: 0 0 10px 0;
            padding: 5px 0 0 0;
        }
    </style>
</head>
<body>
        <hr>
        <table align="center">
            <tr>
                <td style="width:10%">
                    <img src="{{ asset('template/images/logo.jpeg') }}" height="50" width="50"/>
                </td>
                <td style="width:80%; text-align:center;">
                    <h2> ELITE <br> PRESSING AND SHOPPING </h2>
                </td>
                <td style="width:10%">
                    <img src="{{ asset('template/images/logo.jpeg') }}" height="50" width="50"/>
                </td>
            </tr>
        </table>
        <hr>
        <br>

    <div style="color: rgb(50,50,50); width: 100%; margin: auto;" class="panel">
        <div class="panel panel-heading">

        </div>
        <div class="panel-body">
            <div style="width: 100%" class="example-box-wrapper">
                <div>
                    <h3 align="center">Rapport Périodique du {{ \Carbon\Carbon::parse($date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($date_fin)->format('d/m/Y') }}</h3>
                </div>
                <?php 
                    $total = 0; 
                    $total_valider = 0;
                 ?>
                <table id="table" style="font-size: 8px; width: all;" align="center">                    
                    <tbody>
                        <tr style="font-size: 15px;">
                            <th style="width: unset; padding: 10px">Nom du Client</th>                            
                            <th style="width: unset; padding: 10px">N° Tel</th>                            
                            <th style="width: unset; padding: 10px">Adresse</th>
                            <th style="width: unset; padding: 10px">Date de dépôt</th>
                            <th style="width: unset; padding: 10px">Date de livraison</th>
                            <th style="width: unset; padding: 10px">Statut</th>
                            <th style="width: unset; padding: 10px">Total à Payer</th>
                        </tr>
                        @foreach($commandes as $commande)
                            <?php
                                $details_commande = DB::table('details_commande')
                                        ->join('vetements','details_commande.vetement_id','=','vetements.id')
                                        ->where('commande_id',$commande->id)
                                        ->get();
                                $total = 0;
                            ?>
                            @foreach($details_commande as $detail_commande)
                                    <?php
                                        $prix_unit = 0;
                                    ?>
                                @if($detail_commande->laver==1)Laver, 
                                    <?php
                                        $prix_unit += $detail_commande->prix_lavage;
                                    ?>
                                @endif
                                @if($detail_commande->repasser==1)Repasser, 
                                    <?php
                                        $prix_unit += $detail_commande->prix_repassage;
                                    ?>
                                @endif
                                @if($detail_commande->retoucher==1)Retoucher, 
                                    <?php
                                        $prix_unit += $detail_commande->prix_retouche;
                                    ?>
                                @endif
                                    <?php
                                        if($commande->express==1){
                                            $prix_unit = $prix_unit * 2;
                                        }  
                                        $mont_total = $prix_unit * $detail_commande->nombre;
                                        $total += $mont_total;
                                    ?>
                            @endforeach
                            <?php
                                  $totalapayer = 0;
                                  if ($commande->remise>0) {
                                    $totalapayer = ($total - ($total*$commande->remise/100)) + $commande->frais_livraison;
                                  }
                                  else {
                                    $totalapayer = $total + $commande->frais_livraison;
                                  }
                                    
                            ?>
                            <tr style="font-size: 12px;">
                                <td style="width: unset;">{{ $commande->nom_client }}</td>
                                <td style="width: unset;">{{ $commande->tel_client}}</td>
                                <td style="width: unset;">{{ $commande->adresse_client }}</td>
                                <td style="width: unset;">{{ \Carbon\Carbon::parse($commande->date_depot)->format('d/m/Y') }}</td>
                                <td style="width: unset;">{{ \Carbon\Carbon::parse($commande->date_livraison)->format('d/m/Y') }}</td>
                                <td style="width: unset;">@if($commande->statut==0) En attente @else Validée  @endif</td>
                                <td style="width: unset;">{{ $totalapayer }}FCFA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br/>

        </div>
        <div class="panel-footer">

        </div>
    </div>
    </body>
</html>