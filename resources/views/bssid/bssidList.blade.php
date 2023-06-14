@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        
       @include('bssid.modalDelete')
       @include('bssid.modalAdd')
  
        <div><h1 class="text-black-50">Liste des BSSID autorisés</h1></div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <input type="submit" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalAddForm" value="+Ajouter">
            </div>
        </div>

        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">N°</th>
                <th scope="col"> Nom de l'adresse du wifi</th>
                <th scope="col">Adresse du wifi</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                
                @forelse ($bssid as $item) 
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->bssid }}</td>
                        <td>
                            <div class="row">
                                <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#modal-lg-{{$item->id}}">
                                    <i class="fas fa-eye"></i>
                                  </button>
                                <a class="btn btn-success btn-sm mr-2"  href="{{ route('print', $item->id) }} }}" target="_blank"   ><i class="fas fa-print"></i></a>
                                <a class="btn btn-danger btn-sm mr-2" onclick="supprimer(event)" href="{{ route('bssid.destroy', $item->id)}}" data-toggle="modal" data-target="#modalDeleteForm" ><i class="fas fa-trash"></i></a>
                            </div>
                            
                        </td>
                    </tr>

                    

                    @include('bssid.modalViewQrcode')
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
