<div class="modal fade" id="modal-edit-{{ $horaire->id }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Modifier Horaire</font>
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

                <form action="{{ route('horaires.update', $horaire->id) }}" class="vstack grap" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="start_time">Nomination de l'horaire:</label>
                        <input type="text" name="name" id="name" value="{{ $horaire->name }}">
                        <label for="start_time">Début du travail:</label>
                        <input type="time" name="heuredebut" id="heuredebut"
                            value="{{ Carbon\Carbon::parse($horaire->heuredebut)->format('H:i') }}">

                        <label for="end_time">Fin du travail:</label>
                        <input type="time" name="heurefin" id="heurefin"
                            value="{{ Carbon\Carbon::parse($horaire->heurefin)->format('H:i') }}">
                        <label for="start_time">Début du pause:</label>
                        <input type="time" name="heurepausedebut" id="heurepausedebut"
                            value="{{ Carbon\Carbon::parse($horaire->heurepausedebut)->format('H:i') }}">

                        <label for="end_time">Fin de la pause:</label>
                        <input type="time" name="heurepausefin" id="heurepausefin"
                            value="{{ Carbon\Carbon::parse($horaire->heurepausefin)->format('H:i') }}">
                        @php
                            $jours = preg_split('/,\s*/', $horaire->jours, -1, PREG_SPLIT_NO_EMPTY);
                        @endphp
                        <label>Jours de travail :</label>
                        <input type="checkbox" name="jours[]" value="lundi"
                            @if (in_array('lundi', $jours)) checked @endif> Lundi
                        <input type="checkbox" name="jours[]" value="mardi"
                            @if (in_array('mardi', $jours)) checked @endif> Mardi
                        <input type="checkbox" name="jours[]" value="mercredi"
                            @if (in_array('mercredi', $jours)) checked @endif> Mercredi
                        <input type="checkbox" name="jours[]" value="jeudi"
                            @if (in_array('jeudi', $jours)) checked @endif> Jeudi
                        <input type="checkbox" name="jours[]" value="vendredi"
                            @if (in_array('vendredi', $jours)) checked @endif> Vendredi
                        <input type="checkbox" name="jours[]" value="samedi"
                            @if (in_array('samedi', $jours)) checked @endif> Samedi
                        <input type="checkbox" name="jours[]" value="dimanche"
                            @if (in_array('dimanche', $jours)) checked @endif> Dimanche
                    </div>
                    <label for="selectOption">Sélectionnez le contrat attaché :</label>
                    <select id="selectOption" name="contrat_id">
                        <option value=""></option>
                        @foreach ($contrats as $contrat)
                            <option value="{{ $contrat->id }}" @if ($horaire->contrat_id == $contrat->id) selected @endif>
                                {{ $contrat->name }}</option>
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
