<div class="modal fade" id="modalAddForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Configurez un taux</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('taux.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body mx-3">
                    <div class="form-group">
                        <label for="exampleSelectBorder">Grade Agent</label>
                        <select class="custom-select form-control-border" id="exampleSelectBorder" name="grade_id">
                            <option>
                                @foreach($grades as $grade)
                                    <option value="{{$grade->id}}" @selected(old('grade_id', $exist->grade_id)==$grade->id)>{{$grade->name}}</option>
                                @endforeach
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Montant</label>
                        <input type="number" class="form-control" name="montant" placeholder="Salaire de base">
                    </div>
                    <div class="form-group">
                        <label for="">Devise</label>
                        <select class="custom-select form-control-border" id="" name="devise">
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