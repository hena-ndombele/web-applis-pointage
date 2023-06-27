@foreach ($fonctions as $fonction)
<div class="modal fade" id="edit-{{$fonction->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Modifier une fonction</font></font></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{Route("fonctions.update", $fonction->id)}}" class="vstack grap" method="POST">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                  
                    <div class="form-group mb-3">
                        <label for="name">Fonction</label>
                        <input type="text" name="name"  class="form-control"
                            placeholder="Entrez la classe theurapetique" value="{{$fonction->name}}">
                    </div>
                    
                    <div>
                        <button type="submit" class="btn btn-default border float-right"><i class="fas fa-save"></i></button>
                     </div>
                </form>
            </div>
        </div>
    </div>
</div>   
@endforeach
