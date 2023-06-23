@foreach ($fonctions as $fonction)
<div class="modal fade" id="delete-{{ $fonction->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Suppression</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('fonctions.destroy', $fonction->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('delete')
                            <div class="row">
                                Voulez vraiment supprimer la fonction : {{ $fonction->name }}
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-danger float-right ">Supprimer</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach