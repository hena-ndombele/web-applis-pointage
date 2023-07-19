@extends('layouts.app')
@section('title')
<span><a href="{{route('taux.index')}}">Taux</a>/Modification</span>
@endsection
@section('content')
    @php
    $cpt =1;
    $invalidClassRole = "";
    $invalidClassMontant = "";
    $invalidClassDevise = "";    
    $roleInvalidFeedback = "";  
    $montantInvalidFeedback = "";   
    $deviseInvalidFeedback = "";   
    @endphp
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('taux.create')
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-check"></i> Success! {{session('success')}}</h6>
                            </div>
                        @endif
                        @error('grade_id')
                            @php
                                $invalidClassRole = "is-invalid";
                                $roleInvalidFeedback = $message
                            @endphp
                        @enderror
                        @error('montant' )
                            @php
                                $invalidClassMontant = "is-invalid";
                                $montantInvalidFeedback = $message
                            @endphp
                        @enderror
                        @error('devise' )
                            @php
                                $invalidClassDevise = "is-invalid";
                                $deviseInvalidFeedback = $message
                            @endphp
                        @enderror                            <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('taux.update', $exist->id) }}" method="post" id="form" autocomplete="off">
                                @method("PUT")
                                @csrf
                                
                                <div class="modal-body mx-3">
                                    <div class="form-group">
                                        <label for="exampleSelectBorder">Grade</label>
                                        <select class="custom-select form-control-border {{$invalidClassRole}}" id="" name="grade_id">
                                            <option>
                                                @foreach($grades as $grade)
                                                    <option value="{{$grade->id}}" @selected(old('grade_id', $exist->grade_id)==$grade->id)>{{$grade->name}}</option>
                                                @endforeach
                                            </option>
                                        </select>
                                        <span class="invalid-feedback">{{$roleInvalidFeedback}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Montant</label>
                                        <input type="number" class="form-control {{$invalidClassMontant}}" name="montant" placeholder="Salaire de base" value="{{old('montant', $exist->montant)}}">
                                        <span class="invalid-feedback">{{$montantInvalidFeedback}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Devise</label>
                                        <select class="custom-select form-control-border {{$invalidClassDevise}}" id="" name="devise">
                                            <option value="USD"  @selected(old('devise', $exist->devise)=="USD")>DOLLAR (USD)</option>
                                            <option value="CDF"  @selected(old('devise', $exist->devise)=="CDF")>FRANC CONGOLAIS (CDF)</option>
                                        </select>
                                        <span class="invalid-feedback">{{$deviseInvalidFeedback}}</span>
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
