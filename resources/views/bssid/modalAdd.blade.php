

<div class="modal fade" id="modalAddForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Ajouter une adresse wifi autorisé</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{ route('bssid.store') }}" method="post">
                @csrf
                <div class="modal-body mx-3">
                    <div class="md-form mb-2">
                        <i class="fas fa-wifi"></i>
                        <label>Nom de l'adresse du wifi</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="md-form mb-3">
                        <i class="fas fa-wifi"></i>
                        <label>Adresse du wifi</label>
                        <input type="text" name="bssid" class="form-control">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <input type="submit" class="btn " value="Enregistrer" style="background: black;color:white;">
                </div>
            </form>
        </div>
    </div>
</div>

