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
                <th scope="col">Fin</th>
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
                        <td>{{$item->Fin}}</td>
                        <td style="color:
                        @if ($item->status == 'validée')
                            green;
                        @elseif ($item->status == 'rejetée')
                            red;
                        @else
                            orange;
                        @endif"
                        id="status{{ $item->id }}">
                        {{ $item->status }}
                        </td>
                        <td>
                            <div class="row btn-group">
                                <button class="btn btn-success" onclick="validerDemande({{ $item->id }})">
                                    <i class="fas fa-check"></i>
                                </button>
                                
                                <button class="btn btn-danger" onclick="rejeterDemande({{ $item->id }})">
                                    <i class="fas fa-times"></i>
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
          <div>
                {{ $demandes->links() }}
          </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function validerDemande(id) {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir valider cette demande?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085D6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, valider!'
            }).then((result) => {
                if (result.value) {
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
                            motif_rejet: "",
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message=="Demande de congé validée") {
                            Swal.fire({
                                title: data.message,
                                icon: 'success'
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            Swal.fire({
                            icon: 'error',
                            title: data.message,
                        })
                        }
                    })
                }
            })
        }

        function rejeterDemande(id) {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir rejeter cette demande?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, rejeter!'
            })
            .then((result) => {
                if (result.value) {
                    Swal.fire({
                    title: 'Indiquez la raison du rejet',
                    input: 'textarea',
                    icon: 'info',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Vous devez indiquer une raison'
                        }
                    }
                    })
                    .then(data => {
                        if (data.isConfirmed) {
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
                                    motif_rejet: data.value
                                }),
                            })  
                            .then(response => response.json())
                            .then(data => {
                                if (data.message=="Demande de congé rejetée") {
                                    Swal.fire({
                                        title: data.message,
                                        icon: 'success' 
                                    });
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                }   
                                else {
                                    Swal.fire({
                                    icon: 'error',
                                    title: data.message,
                                }) 
                                }                
                            })
                        }
                    })
                }
            }) 
        }
    </script>

@endsection
