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
                <h3>Rapports</h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                  	<a href="{{ route('commandes.create') }}" class="btn btn-primary">Nouvelle Commande</a>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php
                      $date = \Carbon\Carbon::parse($date_commande)->format('d/m/Y');
                  ?>
                    <h2>Rapport Journalier du {{$date}}</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">      
                  	@if(session()->has('message'))
                        @include('partials/message', ['type' => 'info', 'message' => session('message')])
                    @endif           
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('commande.rapportJournalierStore') }}" method="POST">
                      {!! csrf_field() !!}
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Choisir Date de Dépôt<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" class="form-control date" id="date" name="date" placeholder="" required>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button> -->
                          <button type="submit" class="btn btn-success">Valider</button>
                          <button class="btn btn-primary" type="reset">Annuler</button>                          
                        </div>
                      </div>

                    </form>   
                    
                    <a href="{{ route('rapport_journalier.PDF', $date_commande) }}" class="btn btn-info btn-xs pull-right"><i class="fa fa-print"></i> Exporter en PDF </a>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Nom du Client</th>
                          <th>Date de dépôt</th>
                          <th>Date de livraison</th>
                          <th>Statut</th>
                          <th>Voir</th>
                          <th>Modifier</th>
                          <th>Supprimer</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach($commandes as $commande)
                          <tr>
                              <td>{{ $loop->index + 1 }}</td>
                              <td>{{ $commande->nom_client }}</td>                              
                              <td>{{ \Carbon\Carbon::parse($commande->date_depot)->format('d/m/Y') }}</td>
                              <td>{{ \Carbon\Carbon::parse($commande->date_livraison)->format('d/m/Y') }}</td>
                              <td><button type="button" class="btn btn-warning btn-xs">En attente</button></td>
                              <td> <a href="{{ route('commandes.show',$commande->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Voir Plus </a> </td>
                              <td> <a href="{{ route('commandes.edit',$commande->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a> </td>
                              <td>
                                <form id="delete-form-{{$commande->id}}" action="{{ route('commandes.destroy',$commande->id) }}" method="post">
                                  @csrf
                                  {{ method_field('DELETE') }}
                                </form> 
                                <a class="btn btn-danger btn-xs" onclick="
                                    if (confirm('Etes-vous sûr de supprimer celà?')) {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $commande->id }}').submit();
                                    } else {
                                      event.preventDefault();
                                    } "><i class="fa fa-trash-o">
                                      </i>
                                      Supprimer
                                </a>
                              </td>
                          </tr>
                        @endforeach
                      </tbody>

                    </table>
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