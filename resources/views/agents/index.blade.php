@extends('layouts.app')
@section('title')
    Employés
@endsection
@section('content')
    <section class="content">
            @permission('create', 'Agent')
            <div class="text-right mx-4">
                <a class="btn  m-2 " href="{{route('agents.create')}}" style="background: #008B8B;"><b style="color:white;">+</b></a>
            </div>
            @endpermission('create', 'Agent')
            <div class="card">
                
                <div class="card-header">
                    
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- @foreach ($agents as $key => $item)
                            @if ($key % 3 === 0)
                                </div><div class="row">
                            @endif
                            <div class="card-body col-4 px-2">
                                <div class="card mb-4" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="{{ asset('assets/uploads/agents/'.$item->image)   }}" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$item->nom}}</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                            </div>
                                           <div class=" col-lg-5 nav-item dropdown">
                                        <a class=" btn btn-sm btn-primary nav-link"
                                            href="{{ route('agents.show', $item->id) }}">Membres</a>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}
                        @forelse ( $agents as $agent )

  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column bg-transparent">
    <div class="card bg-light d-flex flex-fill">
      <div class="card-header text-muted border-bottom-0">
        Employé
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-7 mt-4">
            <h2 class="lead" ><b>{{$agent->nom}} {{$agent->postnom}} {{$agent->prenom}} </b></h2>
           
          </div>

          <div class="col-5 text-center">
            <a href="/storage/{{ asset('assets/uploads/agents/1686746514.jpg')   }}">
              <img src="/storage/{{$agent->image}}" alt="user-avatar" class="img-circle img-fluid">
            </a>
          
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
          <a href="{{route('agents.edit',$agent->id)}}" class="btn btn-light">
            <i class="fas fa-edit"></i>
          </a>
             
              <a href="{{route('agents.show',$agent->id)}}" class="btn btn-light">
                <i class="fas fa-eye"></i>
              </a>
              <a href="{{route('agents.destroy',$agent->id)}}" data="{{$agent->prenom}} {{$agent->nom}} {{$agent->postnom}}"class="btn btn-danger"  data-toggle="modal" onclick="supprimer(this)" data-target="#exampleModal">
                <i class="fas fa-trash"></i> 
            </a>
        </div>
      </div>
    </div>
  </div>
  @empty

@endforelse
                    </div>
                </div>
            </div> 
        </div>
    </section>
    <div class="d-flex justify-content-center pagination-lg">
      {!! $agents->links('pagination::bootstrap-4') !!}
  </div>
@endsection

@push('page_css')
    @vite('node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')
    @vite('node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')
    @vite('node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')
@endpush

@push('page_scripts')
    <script type="module" src="{{Vite::asset('node_modules/admin-lte/plugins/jquery/jquery.min.js')}}"></script>
    <script type="module" src="{{Vite::asset('node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="module" src="{{Vite::asset('node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script type="module" src="{{Vite::asset('node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script type="module">
        $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": true, "searching": true,"ordering": true,"paging": true,
            "data":""
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
  </script>
@endpush
