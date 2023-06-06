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
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-check"></i> Success! {{session('success')}}</h6>
                                
                            </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Taux de paie configurés</h3>
                        
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <input type="submit" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalAddForm" value="+Configurer">
                            </div>
                        </div>
                            <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Role</th>
                                        <th>Montant</th>
                                        <th>Dévise</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text">
                                    @forelse ($taux as $tx) 
                                    <tr>
                                        <td scope="row">{{ $cpt++ }}</td>
                                        <td>{{ $tx->role->name }}</td>
                                        <td>{{ $tx->montant }}</td>
                                        <td>{{ strtoupper($tx->devise) }}</td>
                                        <td class="col-lg-2">
                                            <form action="{{ route('taux.destroy',$tx->id) }}" method="POST">
                                                <a class="btn btn-outline-primary fas fa-folder" href="{{ route('taux.show',$tx) }}"></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"> 
                                                Aucun taux configuré
                                            </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                
                            </table>
                            <div class="d-flex justify-content-end pagination-xs mt-2">
                                {!! $taux->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
