<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.rep1{
			font: bold;
			margin: auto;
			text-align: center;
			font-size: small;
		}
		.rep{
			margin: auto;
			text-align: center;
			font-size: x-small;

			position:  relative;
			top: 1.5rem;
		}
		.line2{
			border: 1.5px solid;
			position: relative;
			top: 3.8rem;
		}
		.title{
            text-align: center;
            font: bold;
            position:  relative;
			top: 3.5rem;
		}
		table{
			border-collapse: collapse;
			text-align: center;
			/* width: 100%; */
			position: relative;
			top:4rem;
		}
		/* td,th{
			border:1px solid black;
		} */
		.br{
			line-height: 10px;
		}
		.float{
			float: left;
			text-align: center;
			font-size: small;
			position:  relative;
			top: 3.5rem;
		}
		.float_left{
			float: left;
            margin-right: 75 px;
		}
		.float_right{
	      float: right;
	    }
        .footer {
            width: 100%;
            text-align: center;
            position: fixed;
        }
        .footer {
            bottom: 0px;
        }
		
	</style>
	<title></title>
</head>
<body>	
	<div class="float_left">
        <span style="font-weight: bold;">ELITE PRESSING & SHOPPING</span>
        <br> TOTSI, Rue Souzanne,
        <br> en face du CMS "CISSA"
        <br> Lomé - TOGO
        <br> <u>Tél</u>:70-45-73-63/98-81-25-80
	</div> 
    <?php
	      $commande = DB::table('commandes')->where('id',$id)->first();
          $createdAt = \Carbon\Carbon::parse($commande->created_at)->format('d/m/Y H:i:s');
          $date_livraison = \Carbon\Carbon::parse($commande->date_livraison)->format('d/m/Y');

          //facture 
          $facture_id = DB::table('factures')->where('id',$id)->first()->id;
          $facture_number =  sprintf('%06d', $facture_id);
    ?>
    <div class="float_right">
        <span style="font-weight: bold;">Date: </span>{{\Carbon\Carbon::parse($commande->created_at)->format('d/m/Y H:i:s')}}
		<br><br><span style="font-weight: bold;">Facture N° </span>{{$facture_number}}<br>
	</div>

    <img style="border-radius: 25px; margin-top: 10px" src="{{ asset('template/images/logo.jpeg') }}" width="100px">  
	<br>
	<div class="line2"></div>
	<br class="br">
    <br>
    <br>
	
	<div class="title">
		RECU CLIENT
    </div>          
          <table style="width: 100%;">
            <tbody>
					  <tr style="text-align: left">		    
						  <td>Nom du Client: <strong>{{ $commande->nom_client }} {{ $commande->prenom_client }}</strong></td>
                          <td width="30%"></td>
                          <td style="text-align: left;">Date de Livraison: <strong> {{ $date_livraison }} </strong> </td>				
					  </tr>
                      <tr style="text-align: left">
                          <td>Adresse: <strong> {{ $commande->adresse_client }} </strong></td>
                          <td width="30%"></td>
                          <td style="text-align: left;">A Livrer: <strong>@if(is_null($commande->frais_livraison) or ($commande->frais_livraison==0)) Non @else Oui @endif</strong></td>
                      </tr>
                      <tr style="text-align: left">
                          <td>Téléphone: <strong> {{ $commande->tel_client }} </strong> </td>
                          <td width="30%"></td>	
                          @if(is_null($commande->frais_livraison) or ($commande->frais_livraison==0)) 
                          @else
                                <td style="text-align: left;">Adresse de Livraison: <strong> {{ $commande->adresse_livraison }} </strong></td>
                          @endif                          
                      </tr>
            </tbody>
        </table>
        <br>
        <?php
                $details_commande = DB::table('details_commande')
                ->join('vetements','details_commande.vetement_id','=','vetements.id')
                ->where('commande_id',$commande->id)
                ->get();
                $total = 0;
                $mont_total = 0;
        ?>
        <table style="width: 100%">
            <thead>
                <tr>
                    <th style="border:1px solid black;">Désignation(s)</th>
                    <th style="border:1px solid black;">Quantité</th>                    
                    <th style="border:1px solid black;">Opérations</th>
                    <th style="border:1px solid black;">Prix Unitaire</th>
                    <th style="border:1px solid black;">Montant Total</th>
                </tr>
            </thead> 
            <tbody>
                @foreach($details_commande as $detail_commande)
                <?php 
                    $prix_unit = 0;
                ?>
                <tr>
                    <td style="border:1px solid black;">{{ $detail_commande->designation }}</td>                              
                    <td style="border:1px solid black;">{{ $detail_commande->nombre }}</td>                    
                    <td style="border:1px solid black;">
                        @if($detail_commande->laver==1)Laver et Repasser, 
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
                    </td>
                    <?php
                        if($commande->express==1){
                            $prix_unit = $prix_unit * 2;
                        }
                    ?>
                    <td style="border:1px solid black;">{{ $prix_unit }}</td>
                    <?php
                        $mont_total = $prix_unit * $detail_commande->nombre;
                    ?>
                    <td style="border:1px solid black;">{{ $mont_total }}</td>
                    <?php
                        $total += $mont_total;
                    ?>
                </tr>
                @endforeach
                <tr>
                    <td style="border:1px solid black; text-align: right;" colspan="4">Sous Total</td>
                    <td style="border:1px solid black;">{{ $total }}F</td>
                </tr>
                <tr>
                    <td style="border:1px solid black; text-align: right;" colspan="4">Remise(%)</td>
                    <td style="border:1px solid black;">{{ $commande->remise }}%</td>
                </tr>
                <tr>
                    <td style="border:1px solid black; text-align: right;" colspan="4">Frais de livraison</td>
                    <td style="border:1px solid black;">{{ $commande->frais_livraison }}F</td>
                </tr>
                <?php
                    if ($commande->remise>0) {
                    $totalapayer = ($total - ($total*$commande->remise/100)) + $commande->frais_livraison;
                    }
                    else {
                    $totalapayer = $total + $commande->frais_livraison;
                    }                                    
                ?>
                <tr>
                    <td style="border:1px solid black;" colspan="4"><strong>TOTAL</strong></td>
                    <td style="border:1px solid black; font-weight: bold;">{{ $totalapayer }}FCFA</td>
                </tr>
            </tbody>
        </table>
        <br><br><br><br><br><br><br><br>
        <span style="float: right; margin-right: 50px"> Signature du gérant </span>
        <div class="footer">
            <strong> Merci de nous faire confiance, nous sommes toujours disposé à vous servir!!! </strong>
        </div>
</body>
</html>
