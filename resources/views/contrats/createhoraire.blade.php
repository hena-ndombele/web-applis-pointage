<div class="modal fade" id="modal-ajout-horaire" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Horaire</font>
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

                <form action="" class="vstack grap" method="POST" id="ajouthoraire">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Nomination de l'horaire:</label>
                        <input type="text" name="name" id="name">
                        <label for="debut">Début du travail:</label>
                        <input type="time" name="heuredebut" id="heuredebut">

                        <label for="fin">Fin du travail:</label>
                        <input type="time" name="heurefin" id="heurefin">
                        <label for="debut_pause">Début du pause:</label>
                        <input type="time" name="heurepausedebut" id="heurepausedebut">

                        <label for="fin_pause">Fin de la pause:</label>
                        <input type="time" name="heurepausefin" id="heurepausefin">

                        <label>Jours de travail :</label>
                        <input type="checkbox" name="jours[]" value="lundi"> Lundi
                        <input type="checkbox" name="jours[]" value="mardi"> Mardi
                        <input type="checkbox" name="jours[]" value="mercredi"> Mercredi
                        <input type="checkbox" name="jours[]" value="jeudi"> Jeudi
                        <input type="checkbox" name="jours[]" value="vendredi"> Vendredi
                        <input type="checkbox" name="jours[]" value="samedi"> Samedi
                        <input type="checkbox" name="jours[]" value="dimanche"> Dimanche
                    </div>
                    <input type="text" name="contrat_id" id="contrat_id" value="" readonly
                        style="display:none;">

                    <div>
                        <button type="submit" class="btn btn-default border float-right"><i
                                class="fas fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
