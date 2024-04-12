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
                    <h2>Rapport Périodique </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">      
                  	@if(session()->has('message'))
                        @include('partials/message', ['type' => 'info', 'message' => session('message')])
                    @endif           
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('rapport_periodique.PDF') }}" method="POST">

                      {!! csrf_field() !!}
                      <div class="col-md-12">                        
                        <div class="form-group col-sm-6">
                            <label class="col-sm-4 control-label">DATE DEBUT:</label>
                            <div class="col-sm-7">
                                <input type="date" name="date_debut" placeholder="Date de dépôt" class="form-control {{ $errors->has('date_paiement_banque') ? 'parsley-error' : '' }}" value="" required="" 
                                >
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="col-sm-4 control-label">DATE FIN:</label>
                            <div class="col-sm-7">
                                <input type="date" name="date_fin" placeholder="Date de dépôt" class="form-control {{ $errors->has('date_paiement_banque') ? 'parsley-error' : '' }}" value="" required=""
                                >
                            </div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                          <button type="submit" class="btn btn-success">Valider</button>
                          <button class="btn btn-primary" type="reset">Annuler</button>                          
                        </div>
                      </div>

                    </form>   
                
                    
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