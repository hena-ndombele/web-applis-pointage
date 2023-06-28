<div class="modal fade" id="modal-Delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                    <h4 class="modal-title">Supprimer l'horaire</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="" method="post" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body mx-3">
                    <div class="md-form mb-2">
                        <p>Voulez-vous vraiment supprimer ?</p>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>