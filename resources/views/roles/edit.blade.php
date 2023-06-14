@extends('layouts.app')
@section('title')
   <span>Role {{$role->name}}</span>
@endsection
@section('content')
      <div class="container">
         <div class="card">
            <div class="card-body">
                  <form action="{{route('roles.modify', $role->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="role_id" value="{{$role->id}}" id="">
                    <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th style="width: 10px">#</th>
                           <th>Entité</th>
                           <th>Create</th>
                           <th>Read</th>
                           <th>Update</th>
                           <th>Delete</th>
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
                           <td class="icheck-primary  ">
                                 <input type="checkbox" id=""
                                 @php
                                 $verify =  DB::select('select * from role_police where role_id = ? and model = ? and action = ? ', [$role->id, $model, $action] );
                                 @endphp
                                 @if ($verify)
                                 @if (auth()->user()->hasRole('admin'))
                                 checked
                                 @endif
                                 @else
                                 @endif
                                   name="form[{{$model.'_'.$action}}]"  class="justify-center" spellcheck="false">
                           </td>
                           @endforeach
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                    <div>
                     <button type="submit" class="btn btn-default border float-right"><i class="fas fa-save"></i></button>
                  </div>
                  </form>
            </div>
         </div>
      </div>
      
@endsection






