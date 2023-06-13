@extends('layouts.app')

@section('title')
    <span>Liste des congés prevus par la lois</span>
@endsection

@section('content')
    <div class="container-fluid">


         
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>  
                @endforeach
            </ul>
        </div>
    @endif


        @include('conge.modalDelete')
        @include('conge.modalAdd')
        

  
       

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <input type="submit" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalAddForm" value="+Ajouter">
            </div>
        </div>

        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">N°</th>
                <th scope="col">Type de congé</th>
                <th scope="col">Nombre des jours</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                
                @forelse ($conge as $item) 
                    <tr>
                        <th scope="row">{{ $number }}</th>
                        <td>{{ $item->type_conge }}</td>
                        <td>{{ $item->duree }}</td>
                        <td>
                            <div class="row">
                                <a class="btn btn-danger mr-2" onclick="supprimer(event)" href="{{ route('conge.destroy', $item->id)}}" data-toggle="modal" data-target="#modalDeleteForm" ><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @php
                    $number++;
                @endphp
                @empty
                    <tr>
                        <td colspan="5"> 
                            Aucun enregistrement
                        </td>
                  </tr>
                @endforelse
            </tbody>
          </table> 
    </div>


    <script>
        function supprimer(event) {
            var route = event.target.getAttribute('href')
            deleteForm.setAttribute('action', route)
            //alert(route)
        }
    </script>
@endsection
