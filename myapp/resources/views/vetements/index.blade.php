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
                <h3>Vêtements</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                  	<a href="{{ route('vetements.create') }}" class="btn btn-primary">Ajouter un Vêtement</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Liste des differents Vêtements</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">      
                  	@if(session()->has('message'))
                        @include('partials/message', ['type' => 'info', 'message' => session('message')])
                    @endif              
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Désignation</th>
                          <th>Prix Lavage <br>et Repassage</th>
                          <th>Prix Repassage</th>
                          <th>Prix Retouche</th>
                          <th>Modifier</th>
                          <th>Supprimer</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach($vetements as $vetement)
                          <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $vetement->designation }}</td>
                            <td>{{ $vetement->prix_lavage }}</td>
                            <td>{{ $vetement->prix_repassage }}</td>
                            <td>{{ $vetement->prix_retouche }}</td>
                            <td>
                               <a href="{{ route('vetements.edit',$vetement->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            </td>
                            <td>
                               <form id="delete-form-{{$vetement->id}}" action="{{ route('vetements.destroy',$vetement->id) }}" method="post">
                                  @csrf
                                  {{ method_field('DELETE') }}
                                </form> 
                                <a class="btn btn-danger btn-xs" onclick="
                                    if (confirm('Etes-vous sûr de supprimer celà?')) {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $vetement->id }}').submit();
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