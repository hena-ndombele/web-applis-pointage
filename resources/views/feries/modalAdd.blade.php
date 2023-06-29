
<div class="modal fade" id="modalAddForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Ajouter un jour ferié</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{ route('feries.store') }}" method="post">
                @csrf
                <div class="modal-body mx-3">
                    <div class="md-form mb-2">
                        <i class="fa fa-font"></i>
                        <label>Intitulé du feriés</label>
                        <input type="text" name="titre" class="form-control">
                    </div>
                    <div class="md-form mb-3">
                        <i class="fa fa-table"></i>
                        <label>Date</label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="md-form mb-3">
                        <i class="fas fa-pencil-alt"></i>
                        <label>Details</label> 
                        <textarea name="details" class="form-control md-textarea" rows="3"></textarea> 
                    </div>
                    <select class="form-control" name="type">
                        
                        <option value="chomé">Chomé</option>
                        <option value="payé">Payé</option>
                        <option value="chomé et payé">Chomé et payé</option>
                    </select> 
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="Enregistrer">
                </div>
            </form>
        </div>
    </div>
</div>

