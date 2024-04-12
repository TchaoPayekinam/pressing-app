@extends('layouts.app')

@section('headSection')
	  <!-- iCheck -->
    <link href="{{ asset('template/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ asset('template/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('template/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Détails Commande</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                  	<a href="{{ route('commandes.index') }}" class="btn btn-primary">Liste des Commandes</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <!-- <div class="x_title">
                    <h2>Commandes N° {{ $commande->id }}</h2>
                    <a href="{{ route('commandes.create') }}" class="btn btn-primary pull-right">Recu</a>
                    <a href="{{ route('commandes.create') }}" class="btn btn-primary pull-right">Livrer</a>                    
                  </div> -->
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                            <h1>
                                <i class="fa fa-table"></i> Commande N° {{ $commande->id }}
                            </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          <h2>Informations du client</h2>
                          
                                <address style="font-size: 20px">
                                      <br>Nom du Client: <strong>{{ $commande->nom_client }}</strong>
                                      <!-- <br>Prénoms:<strong>{{ $commande->prenom_client }}</strong> -->
                                      <br>Adresse: <strong>{{ $commande->adresse_client }}</strong>
                                      <br>N° Téléphone: <strong>{{ $commande->tel_client }}</strong>
                                </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <h2>Commande</h2>
                          <address style="font-size: 20px">
                              <br>Date de dépôt: <strong>{{ $commande->date_depot }}</strong>
                              <br>Date de livraison prévue: <strong>{{ \Carbon\Carbon::parse($commande->date_livraison)->format('d/m/Y') }}</strong>
                              @if($commande->statut==0)@else<br>Date de livraison réelle: <strong>{{ $commande->date_livraison }}</strong>@endif
                              <br>Statut: <strong>@if($commande->statut==0)<button type="button" class="btn btn-warning btn-xs">En attente</button>@else <button type="button" class="btn btn-success btn-xs">Livrée</button> @endif</strong>
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          @if($commande->express==1)
                            <h2>Etat Traitement</h2>
                                <address style="font-size: 20px">
                                    <br>
                                    <button type="button" class="btn btn-success">&nbsp;&nbsp;&nbsp;Express&nbsp;&nbsp;&nbsp;</button>
                                </address>
                          @endif
                        </div>

                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Désignation</th>
                                <th>Quantité</th>
                                <th>Opérations</th>
                                <th>Prix Unitaire</th>
                                <th>Prix total</th>
                              </tr>
                            </thead>
                            <tbody>
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
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $detail_commande->designation }}</td>                              
                                    <td>{{ $detail_commande->nombre }}</td>
                                    <td>
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
                                    <td>{{ $prix_unit }} FCFA</td>                                    
                                    <?php
                                            $prix_total = $prix_unit * $detail_commande->nombre;
                                    ?>
                                    <td>{{ $prix_total }} FCFA</td>
                                    <?php
                                            $total += $prix_total;
                                    ?>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <!-- <div class="col-xs-6">
                          <p class="lead">Payment Methods:</p>
                          <img src="images/visa.png" alt="Visa">
                          <img src="images/mastercard.png" alt="Mastercard">
                          <img src="images/american-express.png" alt="American Express">
                          <img src="images/paypal.png" alt="Paypal">
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                          </p>
                        </div> -->
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Fiche de la commande</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Montant de la commande:</th>
                                  <td>{{ $total }} FCFA</td>
                                </tr>
                                <tr>
                                  <th>Remise (%)</th>
                                  <td>{{ $commande->remise }}%</td>
                                </tr>
                                <tr>
                                  <th>Frais de livraison (FCFA)</th>
                                  <td>{{ $commande->frais_livraison }} FCFA</td>
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
                                  <th>Montant à payer:</th>
                                  <td>{{ $totalapayer }} FCFA</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <!-- <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button> -->
                          
                          @if($commande->statut==0) 
                                <a href="{{ route('livrerCommande',$commande->id) }}" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Livrer</a>
                          @endif
                          <a href="{{ route('commande.getPDF',$commande->id) }}" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Générer Reçu</a>
                          <!-- <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Générer Reçu</button> -->
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection

@section('scriptSection')
    <!-- iCheck -->
    <script src="{{ asset('template/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('template/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('template/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('template/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
@endsection