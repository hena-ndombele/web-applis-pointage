@extends('layouts.app')
  
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ajouter un nouveau role</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

   
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
   <div class=" col-xs-6 col-sm-6 col-md-6">
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    
                    <input type="text" name="name" class="form-control" placeholder="Saisir un libellé">
                </div>
            </div>
            <div class="row">
            <div class="col-xs-6 col-sm-12 col-md-6 text-left">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
            </div>
        </div>
        
        
        
       
    </form>
   </div>

@endsection