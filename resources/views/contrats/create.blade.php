<div class="modal fade" id="modal-ajout-contrat" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Nouveau Contrat</font>
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

                <form action="{{route('contrats.store')}}" class="vstack grap" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nomination du contrat</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description du contrat</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
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
