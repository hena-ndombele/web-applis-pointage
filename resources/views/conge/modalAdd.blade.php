

<div class="modal fade" id="modalAddForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center"> 
                <h4 class="modal-title w-100 font-weight-bold">Ajouter un congé</h4> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div> 
            <form action="{{ route('conge.store') }}" method="post">
             @csrf 
                <div class="modal-body mx-3"> 
                    <div class="md-form mb-2"> 
                        <i class="fa fa-font"></i> 
                        <label for="type_conge">Intitulé du congé :</label> 
                        <input class="form-control" type="text" name="type_conge" id="type_conge" list="type_conge_list" value="Congé annuel"> 
                        <datalist id="type_conge_list">
                             <option value="Congé annuel"> 
                        </datalist> 
                    </div> 
                    <div class="md-form mb-3"> 
                        <i class="fa fa-table"></i>
                        <label>Nombre des jours</label> 
                        <input type="text" name="duree" class="form-control">
                    </div> 
                </div> 
                    <div class="modal-footer d-flex justify-content-center"> 
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                    </div> 
            </form> 
        </div> 
    </div> 
</div> 

<script>
    document.querySelector('#type_conge').addEventListener('change', function() {
        if (this.value === 'Congé annuel' || this.value === 'congé annuel') {
          document.querySelector('input[name="duree"]').disabled = true;
        } else {
          document.querySelector('input[name="duree"]').disabled = false;
        }
      });
</script>