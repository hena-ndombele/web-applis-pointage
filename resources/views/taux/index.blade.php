@extends('layouts.app')
@section('title')
<span>Taux</span>
@endsection
@section('content')
    @php
    $cpt =1;   
    @endphp
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('taux.create')
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible m-4">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-check"></i> Success! {{session('success')}}</h6>
                            </div>
                        @endif
                        
                        <div class="card-header">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <button type="submit" class="btn btn-outline-default border" title="Configurer" data-toggle="modal" data-target="#modalAddForm"><i class="fas fa-plus-circle"></i></button>
                            </div>
                        </div>
                            <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Grade</th>
                                        <th>Montant</th>
                                        <th>Dévise</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text">
                                    @forelse ($taux as $tx) 
                                    <tr>
                                        <td hidden>{{$tx->id}}</td>
                                        <td scope="row">{{ $cpt++ }}</td>
                                        <td>{{ $tx->grade->name }}</td>
                                        <td>{{ $tx->montant }}</td>
                                        <td>{{ strtoupper($tx->devise) }}</td>
                                        <td class="d-flex">
                                            <a href=" {{ route('taux.edit',$tx->id) }}" title="Modifier"><button class=" btn btn-default mx-1"><i class="fas fa-pencil-alt"></i></button></a>
                                            <form action="{{ route('taux.destroy',$tx) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Supprimer"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <<tr>
                                            <td colspan="8" class="text-center py-4">
                                                <i class="fas fa-exclamation-circle fa-3x text-gray-400"></i>
                                                <p class="text-lg font-bold mt-4">Aucun taux defini</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                
                            </table>
                            
                            <div class="card-footer mt-2">
                                <ul class="pagination pagination-xs m-0 float-right">
                                    <li class="page-item m-1"><a class="page-link" href="{{ $taux->previousPageUrl() }}">Précédent</a></li>
                                    <li class="page-item m-1"><a class="page-link" href="{{ $taux->nextPageUrl() }}">Suivant</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function destroy(event) {
            var route = event.target.getAttribute('href')
            deleteForm.setAttribute('action', route)
            //alert(route)
        }
    </script>
@endsection
