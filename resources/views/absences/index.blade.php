@extends('layouts.app')

@section('content')
    @php
    $cpt =1;   
    @endphp
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Absences</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('absences.index') }}">Absences</a></li>
                <li class="breadcrumb-item active">Liste</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
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
