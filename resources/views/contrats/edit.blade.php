@foreach ($contrats as $contrat)
  <div class="modal fade" id="modal-edit-{{ $contrat->id }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Modifier Contrat</font>
                    </font>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">×</font>
                        </font>
                    </span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('contrats.update', $contrat->id) }}" class="vstack grap" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nomination du contrat</label>
                        <input type="text" name="name" id="name" value="{{ $contrat->name }}"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description du contrat</label>
                        <textarea name="description" id="description"  class="form-control" required>{{ old('description', $contrat->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" value="{{ $contrat->date }}"
                            class="form-control" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default border float-right"><i
                                class="fas fa-save"></i></button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
  
@endforeach
