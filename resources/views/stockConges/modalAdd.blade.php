

<div class="modal fade" id="modalAddForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Stock congé Annuel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{ route('stockConges.store') }}" method="post">
                @csrf
                <div class="modal-body mx-3">
                    <div class="md-form mb-2">
                        <i class="fa fa-font"></i>
                        <label>Grade Agent</label>
                        <select class="custom-select form-control" id="exampleSelectBorder" name="grade_id">
                            <option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </option>
                        </select> 
                    </div>
                    <div class="md-form mb-3">
                        <i class="fa fa-table"></i>
                        <label>Nombre des jours du congé</label>
                        <input type="text" name="totalConge" class="form-control">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="Enregistrer">
                </div>
            </form>
        </div>
    </div>
</div>


