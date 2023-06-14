@extends('layouts.app')
@section('title')
<span>Absence</span>
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
                        <div class="card-header">
                            <h3 class="card-title">Liste des absences signalés</h3>
                        </div>
                            <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Motif</th>
                                        <th>Date</th>
                                        <th>Employé</th>
                                    </tr>
                                </thead>
                                <tbody class="text">
                                    @forelse ($absences as $absence) 
                                    <tr>
                                        <th scope="row">{{ $cpt++ }}</th>
                                        <td>{{ $absence->motif }}</td>
                                    <td>{{ $absence->date_absence, 'D/M/Y' }}</td>
                                    <td>{{ strtoupper($absence->user->name) }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"> 
                                                Aucune absence signalée
                                            </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                
                            </table>
                            <div class="d-flex justify-content-end pagination-xs mt-2">
                                {!! $absences->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
