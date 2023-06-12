@extends('layouts.app')

@section('title')
    <span>Demande des congés</span>
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


        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">N°</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Type de congé</th>
                <th scope="col">Debut</th>
                <th scope="col">Durée</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
    
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                
                @forelse ($demandes as $item)
                    <tr>
                        <th scope="row">{{ $number }}</th>
                        <td>{{$item->user->name}}</td>
                        <td>{{$conge::where('id',$item->conge_id)->first()->type_conge}}</td>
                        <td>{{$item->debut}}</td>
                        <td>{{$item->duree}}</td>
                        <td style="color: {{ $item->status == 'validée' ? 'green' : 'red' }}" id="status{{ $item->id }}">{{ $item->status }}</td>
                        <td>
                            <div class="row btn-group">
                                <button class="btn btn-success" onclick="validerDemande({{ $item->id }})">
                                    <i class="fas fa-check"></i> Valider
                                </button>
                                
                                <button class="btn btn-danger" onclick="rejeterDemande({{ $item->id }})">
                                    <i class="fas fa-times"></i> Rejeter
                                </button>
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
        function validerDemande(id) {
            let url = "{{ route('demandes.update', ':id') }}";
            url = url.replace(':id', id);
            let token = "{{ csrf_token() }}";

            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({
                    status: 'validée',
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let statusCell = document.querySelector('#status' + id);
                    statusCell.style.color = 'green';
                    statusCell.innerHTML = 'validée';
                }
            })
            .catch(error => {
                console.error(error);
            });
        }

        function rejeterDemande(id) {
            let url = "{{ route('demandes.update', ':id') }}";
            url = url.replace(':id', id);
            let token = "{{ csrf_token() }}";

            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({
                    status: 'rejetée',
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let statusCell = document.querySelector('#status' + id);
                    statusCell.style.color = 'red';
                    statusCell.innerHTML = 'rejetée';
                }
            })
            .catch(error => {
                console.error(error);
            });
        }
    </script>

@endsection
