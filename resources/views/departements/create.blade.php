<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Departement</font></font></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{Route("departements.store")}}" class="vstack grap" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="classe_therapeutique">Direction</label>
                        </div>
                        <select  name="direction_id" class="custom-select" id="">
                            <option value=""></option>
                            @foreach($directions as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                  
                    
                    <div class="form-group mb-3">
                        <label for="name">Departement</label>
                        <input type="text" name="name"  class="form-control"
                            placeholder="Entrez la direction" value="{{ old('name') }}">
                    </div>
                    
                    <div>
                        <button type="submit" class="btn btn-default border float-right"><i class="fas fa-save"></i></button>
                     </div>
                
                
                
                
                </form>
            </div>
        </div>
    </div>
</div>