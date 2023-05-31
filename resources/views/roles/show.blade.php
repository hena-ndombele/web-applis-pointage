@extends('layouts.app')

@section('content')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{$role->name}}</h1>
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
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="input-group mb-3">
              </div>
                <table class="table table-bordered">
                   <thead>
                      <tr>
                         <th style="width: 10px">#</th>
                         <th>Entité</th>
                         <th>Create</th>
                         <th>Read</th>
                         <th>Update</th>
                         <th>Delete</th>
                         <th>Action</th>
                        
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($models as $model)
                      <tr>
                         <td> {{++$i}} </td>
                         <td>
                            {{ $model }}
                         </td>
                         @foreach ($actions as $action)
                         <td class="">

                        @php
                        $verify =  DB::select('select * from role_police where role_id = ? and model = ? and action = ? ', [$role->id, $model, $action] );

                        
 
                        @endphp
                        @if ($verify)
                        <i class="fas fa-check"></i>
                        @else
                        <i class="fas fa-circle gray"></i>
                        
                        @endif       

                         </td>
                         
                         @endforeach
                       <td>
                <a class="btn btn-outline-success" href="{{ route('roles.edit', $role->id) }}"><i class="fas fa-pencil-alt"></i></a>

                       </td>
         
                      </tr>
                      @endforeach
                   </tbody>
                </table><br>

        </div>
     </div>
@endsection