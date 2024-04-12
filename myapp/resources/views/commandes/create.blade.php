@extends('layouts.app')

@section('headSection')
    <!-- iCheck -->
    <link href="{{ asset('template/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
@endsection

@section('content')
   <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Commandes</h3>
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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Nouvelle Commande</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="vente_form" data-parsley-validate class="form-horizontal form-label-left">
                          {!! csrf_field() !!}      
                          <div id="error-msg"></div>     
                          
                                <!-- Fieldset Client -->
                                <fieldset class="col-lg-12">
                                    <legend class="legend1"><b> Client </b></legend>
                                    <div class="col-lg-12">
                                          <div class="col-lg-2">
                                              <label for="nomClient">Nom du Client</label>
                                          </div>
                                          <div class="col-lg-3">
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text"  class="form-control" id="nom_client" name="nom_client" placeholder="Nom du client" required>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-lg-2" style="display: none">
                                              <label>Prénom(s)</label>
                                          </div>
                                          <div class="col-lg-3" style="display: none">
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text"  class="form-control" id="prenom_client" name="prenom_client" placeholder="Prénom(s)" required>
                                                  </div>
                                              </div>
                                          </div>
                                    </div>
                                    <div class="col-lg-12">
                                          <div class="col-lg-2">
                                              <label >Adresse</label>
                                          </div>
                                          <div class="col-lg-3">
                                              <div class="form-group">
                                                  <div class="form-line">
                                                      <input type="text" class="form-control" id="adresse_client" name="adresse_client" placeholder="Adresse" required>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-lg-2">
                                              <label for="telClient">Numéro de téléphone</label>
                                          </div>
                                          <div class="col-lg-3">
                                              <div class="demo-masked-input">
                                                  <div class="form-group form-float {!! $errors->has('tel') ? 'has-error' : '' !!}" >
                                                      <div class="form-line">
                                                            <input type="text" class="form-control my-phone-number" id="tel_client" name="tel_client" placeholder="Ex: +(000) 00-00-00-00" required>
                                              {!! $errors->first('tel', '<small class="help-block">:message</small>') !!}
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                    </div>
                                </fieldset>
                                <!-- End Fieldset Client-->               
                                <fieldset class="col-lg-12">
                                    <legend class="legend"><b>Commande à réaliser</b></legend>

                                    <div class="col-md-12">
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                                          <label>Type Vêtement</label>
                                        </div>

                                        <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                          <label>Nombre</label>
                                        </div>

                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                                          <label>Opérations</label>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                        <select class="form-control" id="vetement_id" name="vetement[]">
                                            <option disabled="">Choose option</option>
                                            @foreach($vetements as $vetement)
                                              <option style="font-weight: bold;" value={{$vetement->id}}> 
                                                    {{$vetement->designation}}
                                              </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group">
                                          <input type="text" class="form-control" required="" id="nombre" name="nombre[]">
                                    </div>

                                    <div class="col-md-7 col-sm-6 col-xs-12 form-group">
                                      <div class="col-md-3">
                                        <label>Laver et Repasser*:</label>
                                        <p>
                                          Oui: <input type="radio" class="flat" name="laver[]" id="laver" value="1" checked="" required /> 
                                          Non: <input type="radio" class="flat" name="laver[]" id="laver" value="0" />
                                        </p>
                                      </div>
                                      <div class="col-md-3">                                        
                                        <label>Repasser *:</label>
                                        <p>
                                          Oui: <input type="radio" class="flat" name="repasser[]" id="repasser" value="1" checked="" required /> 
                                          Non: <input type="radio" class="flat" name="repasser[]" id="repasser" value="0" /> 
                                        </p>
                                      </div>
                                      <div class="col-md-3">
                                        <label>Retoucher *:</label>
                                        <p>
                                          Oui: <input type="radio" class="flat" name="retoucher[]" id="retoucher" value="1" checked="" required /> 
                                          Non: <input type="radio" class="flat" name="retoucher[]" id="retoucher" value="0" /> 
                                        </p>
                                      </div>
                                      
                                        <button style="margin-left: 0px;" type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>                                                                          
                                    </div>
                                   
                                    <div id="dynamic_field">
                                      
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                      <label>Date de livraison</label>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                      <label>Remise(%)</label>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                      <label>Frais de livraison</label>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                      <label>Adresse de livraison</label>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                      <label>Traitement Express</label>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                      <div class="form-group">
                                            <div class="form-line">
                                                <input type="date"  class="form-control date" id="date_livraison" name="date_livraison" placeholder="" required>
                                            </div>
                                      </div>
                                    </div>                                    
                                      
                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number"  class="form-control" id="remise" name="remise" placeholder="%" value="0">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="frais_livraison" name="frais_livraison" placeholder="Frais de livraison" value="0">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text"  class="form-control" id="adresse_livraison" name="adresse_livraison" placeholder="Adresse de livraison" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="flat" id="express" name="express" value="1"> Oui
                                            </label>
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-5">
                                        <label>Photo</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail"></div>
                                            
                                            <div>
                                                <button class="btn btn-file btn-sm btn-gr-gray" type="button"> 
                                                    <span class="fileupload-new">Select image</span>
                                                    <span class="fileupload-exists">Change</span>
                                                    <input type="file" name="photo"/>
                                                </button>
                                                <a href="#" class="btn fileupload-exists btn-sm btn-gr-gray" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div> -->
                                
                                </fieldset>
                                <!--End Fieldset Informations personnelles -->

                                <!-- <div class="col-lg-1"></div> -->


                          <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                              <button type="button" id="submit" class="btn btn-success">Valider</button>
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

    <script>
        let input = document.getElementById("frais_livraison");
        let input_adresse = document.getElementById("adresse_livraison");
        //button.disabled = true;
        input.addEventListener("input", stateHandle);

        function stateHandle() {
            if((document.getElementById("frais_livraison").value === "")||(document.getElementById("frais_livraison").value == 0)) {
                input_adresse.disabled = true;
            } else {
                input_adresse.disabled = false;
            }
        }
    </script>

    <script type="text/javascript">

         <?php 
             $vetements = App\Models\Vetement::get();             
         ?>
         $(function() {

            var i = 1;
            $('#add').click(function(){                
                $('#dynamic_field').append('<div id="row'+i+'"><div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback"><select class="form-control" id="vetement_id" name="vetement[]><option disabled="">Choose option</option>@foreach($vetements as $vetement)<option style="font-weight: bold;" value={{$vetement->id}}>{{$vetement->designation}}</option>@endforeach</select></div><div class="col-md-2 col-sm-6 col-xs-12 form-group"><input type="text" class="form-control" id="nombre" name="nombre[]"></div> <div class="col-md-7 col-sm-6 col-xs-12 form-group"><div class="col-md-3"><label>Laver et Repasser*:</label><p>  Oui: <input type="radio" class="flat" name="laver['+i+']" id="laver" value="1" checked="" required />   Non: <input type="radio" class="flat" name="laver['+i+']" id="laver" value="0" /></p></div><div class="col-md-3"><label>Repasser *:</label><p>  Oui: <input type="radio" class="flat" name="repasser['+i+']" id="repasser" value="1" checked="" required />   Non: <input type="radio" class="flat" name="repasser['+i+']" id="repasser" value="0" /> </p></div><div class="col-md-3"><label>Retoucher *:</label><p>  Oui: <input type="radio" class="flat" name="retoucher['+i+']" id="retoucher" value="1" checked="" required />   Non: <input type="radio" class="flat" name="retoucher['+i+']" id="retoucher" value="0" /> </p></div> <button name="remove" id="'+i+'" class="btn btn-danger btn-remove">X</button> </div></div>');
                i++;
            });
            $(document).on('click', '.btn-remove', function(){
                 var button_id = $(this).attr("id");
                 $('#row'+button_id+'').remove();
            })

            $('#submit').click(function() {

                /*var laver = [];

                $("input[name='laver']:checked").each(function(){
                    laver.push(this.value);
                });
                $('.laver').each(function(){
                  if ($(this).is(":checked")) {
                    laver.push(this.value);
                  }                                     
                });*/
                $.ajax({
                    url: "{{route('commandes.store')}}",
                    method: "POST",
                    data: $('#vente_form').serialize(),                       
                    //data: $('#vente_form').serialize() + "&laver="+laver,                       
                    dateType : "json",
                    success:function(message)
                    {
                        var message = $.parseJSON(message);

                        if (message.status == 'true') {
                            $('#error-msg').html('<div class="alert alert-info alert-dismissable" style="font-size:15px"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>'+'Opération effectuée avec succès'+'</p></div>');
                            setTimeout(function() {
                                window.location.href = message.redirect_url;
                            },1000);

                            $('#vente_form')[0].reset();
                        }/*
                        else if(message.status == 'empty') {
                            $('#error-msg').html('<div class="alert alert-danger alert-dismissable" style="font-size:15px; width:75%; margin: auto"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>'+'Veuillez Choisir un article et remplir la quantite avant de valider'+'</p></div>'); 
                        }*/
                        else if(message.status == 'empty_commande') {
                            $('#error-msg').html('<div class="alert alert-danger alert-dismissable" style="font-size:15px; width:100%; margin: auto"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>'+'Veuillez renseigner toutes les informations necessaires de la commande avant de valider'+'</p></div>'); 
                        }
                        else if(message.status == 'empty_user') {
                            $('#error-msg').html('<div class="alert alert-danger alert-dismissable" style="font-size:15px; width:100%; margin: auto"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>'+'Veuillez renseigner toutes les informations du client avant de valider'+'</p></div>');
                        }
                        else {
                            $('#error-msg').html('<div class="alert alert-warning alert-dismissable" style="font-size:15px; width:75%; margin: auto"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>'+'Cette vente ne peut pas être effectuée, Rupture de stock pour l\'article '+message.libelle+'</p></div>'); 
                        }
                    }
                })
            })

         })
     </script>
@endsection
