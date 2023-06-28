@extends('layouts.app')

@section('title')
    <span>Liste des feriés légaux</span>
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


        @include('feries.modalDelete')
        @include('feries.modalAdd')
        

  
       

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <input type="submit" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalAddForm" value="+Ajouter">
            </div>
        </div>

        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col" class="col-1">N°</th>
                <th scope="col" class="col-2">Titre</th>
                <th scope="col" class="col-1">Date</th>
                <th scope="col" class="col-5">Détails</th>
                <th scope="col" class="col-1">Type</th>
                <th scope="col" class="col-1">Action</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                
                @forelse ($feries as $item) 
                    <tr>
                        <th scope="row">{{ $number }}</th>
                        <td>{{ $item->titre }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->details }}</td>
                        <td>{{ $item->type }}</td>
                        <td>
                            <div class="row">
                                <a class="btn btn-danger mr-2" onclick="supprimer(event)" href="{{ route('feries.destroy', $item->id)}}" data-toggle="modal" data-target="#modalDeleteForm" ><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @php
                    $number++;
                @endphp
                @empty
                    <tr>
                        <td colspan="12"> 
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
