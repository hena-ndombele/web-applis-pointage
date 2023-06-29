@extends('layouts.app')
@section('title')
<span><a href="{{route('structure.index')}}">Structure salariale </a>/ Modification</span>
@endsection
@section('content')
    @php
    $cpt =1;
    $invalidClassRubrique = "";
    $invalidClassValeur = "";
    $invalidClassUnite = "";    
    $invalidClassType = "";   
    $invalidClassMouvement = "";   
    $rubriqueInvalidFeedback = "";  
    $valeurInvalidFeedback = "";   
    $uniteInvalidFeedback = "";
    $typeInvalidFeedback = "";
    $mouvementInvalidFeedback = "";
    @endphp
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-check"></i> {{session('success')}}</h6>
                            </div>
                        @endif
                        @error('rubrique' )
                            @php
                                $invalidClassRubrique = "is-invalid";
                                $rubriqueInvalidFeedback = $message
                            @endphp
                        @enderror
                        @error('type' )
                            @php
                                $invalidClassType = "is-invalid";
                                $typeInvalidFeedback = $message
                            @endphp
                        @enderror
                        @error('mouvement' )
                            @php
                                $invalidClassMouvement = "is-invalid";
                                $mouvementInvalidFeedback = $message
                            @endphp
                        @enderror
                        @error('valeur' )
                            @php
                                $invalidClassValeur = "is-invalid";
                                $valeurInvalidFeedback = $message
                            @endphp
                        @enderror
                        @error('unite' )
                            @php
                                $invalidClassUnite = "is-invalid";
                                $uniteInvalidFeedback = $message
                            @endphp
                        @enderror                            <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('structure.update', $structure->id) }}" method="post" id="form" autocomplete="off">
                                @method("PUT")
                                @csrf
                                
                                <div class="modal-body mx-3">
                                    <div class="form-group">
                                        <label for="">RUBRIQUE</label>
                                        <input type="text" class="form-control {{$invalidClassRubrique}}" name="rubrique" placeholder="L'intitulé de la rubrique" value="{{old('rubrique', $structure->rubrique)}}">
                                        <span class="invalid-feedback">{{$rubriqueInvalidFeedback}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Type</label>
                                        <select class="custom-select form-control-border {{$invalidClassType}}" id="" name="type">
                                            <option value=""></option>
                                            <option value="FIXE"  @selected(old('type', $structure->type)=="FIXE")>FIXE</option>
                                            <option value="DYNAMIQUE"  @selected(old('type', $structure->type)=="DYNAMIQUE")>DYNAMIQUE</option>
                                        </select>
                                        <span class="invalid-feedback">{{$uniteInvalidFeedback}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mouvement</label>
                                        <select class="custom-select form-control-border {{$invalidClassMouvement}}" id="" name="mouvement">
                                            <option value=""></option>
                                            <option value="GAIN"  @selected(old('mouvement', $structure->mouvement)=="GAIN")>GAIN</option>
                                            <option value="RETENU"  @selected(old('mouvement', $structure->mouvement)=="RETENU")>RETENU</option>
                                        </select>
                                        <span class="invalid-feedback">{{$uniteInvalidFeedback}}</span>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="">VALEUR</label>
                                        <input type="text" class="form-control {{$invalidClassValeur}}" name="valeur" placeholder="La valeur de la rubrique" value="{{old('valeur', $structure->valeur)}}">
                                        <span class="invalid-feedback">{{$valeurInvalidFeedback}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">UNITE</label>
                                        <select class="custom-select form-control-border {{$invalidClassUnite}}" id="" name="unite">
                                            <option value=""></option>
                                            <option value="%"  @selected(old('unite', $structure->unite)=="%")>POURCENTAGE (%)</option>
                                            <option value="USD"  @selected(old('unite', $structure->unite)=="USD")>DOLLAR (USD)</option>
                                            <option value="CDF"  @selected(old('unite', $structure->unite)=="CDF")>FRANC CONGOLAIS (CDF)</option>
                                        </select>
                                        <span class="invalid-feedback">{{$uniteInvalidFeedback}}</span>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer justify-content-end">
                                    <button type="submit" class="btn btn-outline-success"title='Enrégistrer la modification'><i class="fas fa-save"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
