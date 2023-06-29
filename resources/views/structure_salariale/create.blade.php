<div class="modal fade" id="modalAddForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Configurez une nouvelle structure salariale</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('structure.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body mx-3">
                    <div class="form-group">
                        <label for="">RUBRIQUE</label>
                        <input type="text" class="form-control" name="rubrique" placeholder="L'intitulé de la rubrique">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectBorder">TYPE</label>
                        <select class="custom-select form-control-border" id="exampleSelectBorder" name="type">
                            <option value=""></option>
                            <option value="FIXE">FIXE</option>
                            <option value="DYNAMIQUE">DYNAMIQUE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectBorder">MOUVEMENT</label>
                        <select class="custom-select form-control-border" id="exampleSelectBorder" name="mouvement">
                            <option value=""></option>
                            <option value="GAIN">GAIN</option>
                            <option value="RETENU">RETENU</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">VALEUR</label>
                        <input type="text" class="form-control" name="valeur" placeholder="La valeur de la rubrique">
                    </div>
                    <div class="form-group">
                        <label for="">UNITE</label>
                        <select class="custom-select form-control-border" id="" name="unite">
                            <option value=""></option>
                            <option value="%">POURCENTAGE (%)</option>
                            <option value="USD">DOLLAR (USD)</option>
                            <option value="CDF">FRANC CONGOLAIS (CDF)</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer d-flex justify-content-end mt-2">
                    <button type="submit" class="btn btn-outline-success border" title="Enregistrer"><i class="fas fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>