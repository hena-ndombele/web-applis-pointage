
    <div class="modal fade" id="modalUpdateForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Modifier un congé</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="{{ route('conge.update', $conge->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body mx-3">
                        <div class="md-form mb-2">
                            <i class="fa fa-font"></i>
                            <label>Intitulé du congé</label>
                            <input type="text" name="name" class="form-control" value="{{ $conge->name}}">
                        </div>
                        <div class="md-form mb-3">
                            <i class="fa fa-table"></i>
                            <label>Nombre des jours</label>
                            <input type="text" name="duree" class="form-control" value="{{ $conge->duree}}">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <input type="submit" class="btn btn-primary" value="Modifier">
                    </div>
                </form>
            </div>
        </div>
    </div>
