@extends('layouts.app')
@section('title')
<span>Structure salariale</span>
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
                        @include('structure_salariale.create')
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible m-4">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-check"></i> {{session('success')}}</h6>
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
                                        <th>Rubrique</th>
                                        <th>Type</th>
                                        <th>Mouvement</th>
                                        <th>Valeur</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text">
                                    @forelse ($structures as $structure) 
                                    <tr>
                                        <td scope="row">{{ $cpt++ }}</td>
                                        <td>{{ $structure->rubrique }}</td>
                                        <td>{{ $structure->type }}</td>
                                        <td>{{ $structure->mouvement }}</td>
                                        <td>{{ $structure->valeur.' '.$structure->unite }}</td>
                                        <td class="d-flex">
                                            <a href=" {{ route('structure.edit',$structure->id) }}" title="Modifier"><button class=" btn btn-default mx-1"><i class="fas fa-pencil-alt"></i></button></a>
                                            <form action="{{ route('structure.destroy',$structure) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Supprimer"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"> 
                                                Aucune structure salariale configurée
                                            </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                
                            </table>
                            
                            <div class="card-footer mt-2">
                                <ul class="pagination pagination-xs m-0 float-right">
                                    <li class="page-item m-1"><a class="page-link" href="{{ $structures->previousPageUrl() }}">Précédent</a></li>
                                    <li class="page-item m-1"><a class="page-link" href="{{ $structures->nextPageUrl() }}">Suivant</a></li>
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
