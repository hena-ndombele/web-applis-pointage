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

                <form action="{{ route('contrats.store') }}" class="vstack grap" method="POST">
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
                        <label for="type">Type de contrat</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="CDI">CDI</option>
                            <option value="CDD">CDD</option>
                            <option value="Intérimaire">Intérimaire</option>
                        </select>
                    </div>
                    <div class="form-group" id="duree_div" style="display:none;">
                        <label for="duree">Durée</label>
                        <input type="text" name="duree" id="duree" class="form-control">
                    </div>
                    <div class="form-group" id="unite_duree_div" style="display:none;">
                        <label for="unite_duree">Unité de la durée</label>
                        <select name="unite_duree" id="unite_duree" class="form-control">
                            <option value=""></option>
                            <option value="Jour(s)">Jour(s)</option>
                            <option value="Semaine(s)">Semaine(s)</option>
                            <option value="Mois">Mois</option>
                            <option value="Année(s)">Année(s)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="direction_id">Direction</label>
                        <select name="direction_id" id="direction_id" class="form-control" required>
                            <option value=""></option>
                            @foreach ($directions as $direction)
                                <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fonction_id">Fonction</label>
                        <select name="fonction_id" id="fonction_id" class="form-control" required>
                            <option value=""></option>
                            @foreach ($fonctions as $fonction)
                                <option value="{{ $fonction->id }}">{{ $fonction->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horaire_id">Horaire</label>
                        <select name="horaire_id" id="horaire_id" class="form-control" required>
                            <option value=""></option>
                            @foreach ($horaires as $horaire)
                                <option value="{{ $horaire->id }}">{{ $horaire->name }}</option>
                            @endforeach
                        </select>
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
