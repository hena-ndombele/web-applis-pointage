<div class="modal fade" id="modalAddForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Configurez un taux</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('taux.store') }}" method="post">
                @csrf
                <div class="modal-body mx-3">
                    <div class="form-group">
                        <label for="exampleSelectBorder">Role</label>
                        <select class="custom-select form-control-border" id="exampleSelectBorder" name="role_id">
                            <option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" @selected(old('role_id', $exist->role_id)==$role->id)>{{$role->name}}</option>
                                @endforeach
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Montant</label>
                        <input type="number" class="form-control" name="montant" placeholder="Salaire de base" value="{{old('montant', $exist->montant)}}">
                    </div>
                    <div class="form-group">
                        <label for="">Devise</label>
                        <select class="custom-select form-control-border" id="" name="devise">
                            <option value="USD" @selected(old('devise', $exist->devise)=="USD")>DOLLAR (USD)</option>
                            <option value="CDF" @selected(old('devise', $exist->devise)=="CDF")>FRANC CONGOLAIS (CDF)</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer d-flex justify-content-center mt-2">
                    <input type="submit" class="btn btn-primary" value="Enregistrer">
                </div>
            </form>
        </div>
    </div>
</div>