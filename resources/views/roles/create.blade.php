@extends('layouts.app')
@section('title')
    <span>Ajouter d'un nouveau role</span>
@endsection
@section('content')

<div class="container">
    <div class="col-md-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oups! </strong> Il y a eu des problèmes avec votre entrée.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card">
            <div class="card-body">
              <div class=" col-xs-12 col-sm-12 col-md-12">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                      <div class="container">
                          <div class="row">
                              <div class="">
                                  <div class="form-group">
                                      <input type="text" name="name" class="form-control" placeholder="Saisir un libellé">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-xs-6 col-sm-12 col-md-12 text-right">
                                  <button type="submit" class="btn btn-light"><i class="fas fa-save"></i></button>
                          </div>
                          </div>
                      </div>
          
          
                </form>
               </div>
            </div>
          </div>
    </div>

</div>

@endsection





