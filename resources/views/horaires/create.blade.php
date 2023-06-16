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
                

                <form action="{{ route('horaires.store') }}" class="vstack grap" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="start_time">Nomination de l'horaire:</label>
                        <input type="text" name="name" id="name">
                        <label for="start_time">Début du travail:</label>
                        <input type="time" name="heuredebut" id="heuredebut">

                        <label for="end_time">Fin du travail:</label>
                        <input type="time" name="heurefin" id="heurefin">
                        <label for="start_time">Début du pause:</label>
                        <input type="time" name="heurepausedebut" id="heurepausedebut">

                        <label for="end_time">Fin de la pause:</label>
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
                    <label for="selectOption">Sélectionnez le contrat attaché :</label>
                    <select id="selectOption" name="contrat_id">
                        <option value=""></option>
                        @foreach ($contrats as $contrat)
                            <option value="{{ $contrat->id }}">{{ $contrat->name }}</option>
                        @endforeach
                    </select>

                    <div>
                        <button type="submit" class="btn btn-default border float-right"><i
                                class="fas fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
