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
                <th scope="col">N°</th>
                <th scope="col">Titre</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
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
