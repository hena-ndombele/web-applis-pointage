@extends('layouts.app')
@section('title')
<span><a href="{{route('paie.index')}}">Paie</a> / Agent {{strtolower($status)}}</span>
@endsection
@section('content')
    @php
        $cpt =1;  
        $type = ""; 
    @endphp
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible m-4">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-check"></i> {{session('success')}}</h6>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible m-4">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-ban"></i>{{session('error')}}</h6>
                            </div>
                        @endif
                        <div class="card-header">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <a href="{{ route('paie.pdf', ['status'=>$status])}}" class="btn btn-outline-success border" title="Générer le pdf" d><i class="fas fa-file-pdf"></i></a>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link" id="custom-content-below-home-tab"  href="{{ route('paie.index') }}" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Tous</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="custom-content-below-messages-tab"  href="{{ route('paie.show', "PAYE") }}" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Payés</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="custom-content-below-settings-tab"  href="{{ route('paie.show', "EN ATTENTE") }}" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">En attente</a>
                            </li>
                          </ul>  
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Agent</th>
                                        <th>Nombre des jours</th>
                                        <th>Montant de base</th>
                                        <th>Salaire Mensuel</th>
                                        <th>Dévise</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text">
                                    @forelse ($paies as $paie) 
                                    <tr>
                                        <td scope="row">{{ $cpt++ }}</td>
                                        <td>{{ strtoupper($paie->user->name) }}</td>
                                        <td>{{ $paie->jours_presents }}</td>
                                        <td>{{ $paie->taux_configuration->montant .' '. $paie->taux_configuration->devise }}</td>
                                        <td>{{ $paie->taux_configuration->montant*$paie->jours_presents }}</td>
                                        <td>{{ ($paie->taux_configuration->devise) }}</td>
                                        <td class="d-flex">
                                            
                                            <form action="{{ route('paie.update', $paie->id) }}" method="POST">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden" name="user_id" value="{{$paie->id}}">
                                                <input type="hidden" name="taux_id" value="{{$paie->id}}">
                                                @if($paie->paie_status != "PAYE")
                                                    <button type="submit" class=" btn btn-outline-success mx-1" title="Payer l'agent"><i class="fas fa-plus-circle"></i></button>
                                                @elseif($paie->paie_status == "PAYE")
                                                    <a href="{{ route('paie.pdf', ['status'=>$status])}}" class="btn btn-outline-success mx-1" title="Générer la fiche de paie" d><i class="fas fa-file-pdf"></i></a>
                                                @endif
                                            </form>
                                            <form action="{{ route('paie.destroy',$paie->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Annuler"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"> 
                                                Aucune agent disponible pour cette partie
                                            </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                
                            </table>
                            
                            {{-- <div class="card-footer mt-2">
                                <ul class="pagination pagination-xs m-0 float-right">
                                    <li class="page-item m-1"><a class="page-link" href="{{ $paies->previousPageUrl() }}">Précédent</a></li>
                                    <li class="page-item m-1"><a class="page-link" href="{{ $paies->nextPageUrl() }}">Suivant</a></li>
                                </ul>
                            </div> --}}
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
@extends('layouts.app')
@section('title')
<span><a href="{{route('paie.index')}}">Paie</a> / Agent {{strtolower($status)}}</span>
@endsection
@section('content')
    @php
        $cpt =1;  
        $type = ""; 
        $salaire = 0;
        $gain = 0;
        $retenu = 0;
        $sommeRetenu= 0;
        $sommeGain= 0;
    @endphp
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible m-4">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-check"></i> {{session('success')}}</h6>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible m-4">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-ban"></i>{{session('error')}}</h6>
                            </div>
                        @endif
                        <div class="card-header">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <a href="{{ route('paie.pdf', ['status'=>$status])}}" class="btn btn-outline-success border" title="Générer le pdf" d><i class="fas fa-file-pdf"></i></a>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link" id="custom-content-below-home-tab"  href="{{ route('paie.index') }}" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Tous</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="custom-content-below-messages-tab"  href="{{ route('paie.show', "PAYE") }}" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Payés</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="custom-content-below-settings-tab"  href="{{ route('paie.show', "EN ATTENTE") }}" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">En attente</a>
                            </li>
                          </ul>  
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead class="justify-content-center">
                                        <tr class="justify-content-center">
                                            <th>N°</th>
                                            <th>Agent</th>
                                            <th>Nombre des jours</th>
                                            <th>Montant de base</th>
                                            {{-- <th class="col text-center">
                                                <div class="row text-center">Allocation</div>
                                                <div class="row">
                                                    @forelse ($fiches as $fiche)
                                                        <div class="col">{{ $fiche->rubrique }}</div>
                                                    @empty
                                                        <div class="col">Aucune</div>
                                                    @endforelse
                                                    
                                                </div>
                                            </th> --}}
                                            <th>Salaire Mensuel</th>
                                            <th>Dévise</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text">
                                        @forelse ($paies as $paie) 
                                        @php
                                            $base = $paie->taux_configuration->montant*$paie->jours_presents;
                                        @endphp
                                        <tr>
                                            <td scope="row">{{ $cpt++ }}</td>
                                            <td>{{ strtoupper($paie->user->name) }}</td>
                                            <td>{{ $paie->jours_presents }}</td>
                                            <td>{{ $paie->taux_configuration->montant .' '. $paie->taux_configuration->devise }}</td>        
                                            @forelse($fiches as $fiche)
                                                @php
                                                    if($fiche->mouvement == 'GAIN'){
                                                        if($fiche->unite != "%"){
                                                            $gain = $gain + $fiche->valeur;
                                                        }else{
                                                            $gain = $gain + ($base*$fiche->valeur/100);
                                                        }
                                                        $sommeGain = $sommeGain + $gain;
                                                    }
                                                    if($fiche->mouvement == 'RETENU'){
                                                        if($fiche->unite != "%"){
                                                            $retenu = $retenu + $fiche->valeur;
                                                        }else{
                                                            $retenu = $retenu + ($base*$fiche->valeur/100);
                                                        }
                                                        $sommeRetenu = $sommeRetenu + $retenu;
                                                    }
                                                    
                                                @endphp
                                            @empty
                                            @endforelse
                                            @php
                                                $salaire = $base + $sommeGain - $sommeRetenu;
                                            @endphp   
                                            <td>{{ $salaire }}</td>
                                            <td>{{ ($paie->taux_configuration->devise) }}</td>
                                            <td class="d-flex">
                                                
                                                <form action="{{ route('paie.update', $paie->id) }}" method="POST">
                                                    @csrf
                                                    @method("PUT")
                                                    <input type="hidden" name="user_id" value="{{$paie->id}}">
                                                    <input type="hidden" name="taux_id" value="{{$paie->id}}">
                                                    @if($paie->paie_status != "PAYE")
                                                        <button type="submit" class=" btn btn-outline-success mx-1" title="Payer l'agent"><i class="fas fa-plus-circle"></i></button>
                                                    @elseif($paie->paie_status == "PAYE")
                                                        <a href="{{ route('fiche_paie.pdf', ['id'=>$paie->id])}}" class="btn btn-outline-success mx-1" title="Générer la fiche de paie" d><i class="fas fa-file-pdf"></i></a>
                                                    @endif
                                                </form>
                                                <form action="{{ route('paie.destroy',$paie->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" title="Annuler"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5"> 
                                                    Aucune agent disponible pour cette partie
                                                </td>
                                        </tr>
                                        @endforelse
                                    </tbody>  
                                </table>
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
