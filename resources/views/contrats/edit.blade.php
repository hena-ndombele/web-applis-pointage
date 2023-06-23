@foreach ($contrats as $contrat)
    <div class="modal fade modal-edit-{{ $contrat->id }}" id="modal-edit-{{ $contrat->id }}" style="display: none;" aria-hidden="true">
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
                            <input type="text" name="name" id="name"  value="{{ $contrat->name }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description du contrat</label>
                            <textarea name="description" id="description" class="form-control" required>{{ old('description', $contrat->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="type">Type de contrat</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="CDI" @if ($contrat->type == "CDI") selected @endif >CDI</option>
                                <option value="CDD"@if ($contrat->type == "CDD") selected @endif>CDD</option>
                                <option value="Intérimaire" @if ($contrat->type == "Intérimaire") selected @endif>Intérimaire</option>
                            </select>
                        </div>
                        <div class="form-group" id="duree_div" style="display:none;">
                            <label for="duree">Durée</label>
                            <input type="text" name="duree" id="duree"  class="form-control"
                                value="{{ $contrat->duree }}">
                        </div>
                        <div class="form-group" id="unite_duree_div" style="display:none;">
                            <label for="unite_duree">Unité de la durée</label>
                            <select name="unite_duree" id="unite_duree" class="form-control">
                                <option value="Jour(s)" {{ old('unite_duree', $contrat->unite_duree) == 'Jour(s)' ? 'selected' : '' }}>Jour(s)</option>
                                <option value="Semaine(s)" {{ old('unite_duree', $contrat->unite_duree) == 'Semaine(s)' ? 'selected' : '' }}>Semaine(s)</option>
                                <option value="Mois" {{ old('unite_duree', $contrat->unite_duree) == 'Mois' ? 'selected' : '' }}>Mois</option>
                                <option value="Année(s)"{{ old('unite_duree', $contrat->unite_duree) == 'Année(s)' ? 'selected' : '' }}>Année(s)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="direction_id">Direction</label>
                            <select name="direction_id" id="direction_id" class="form-control" required>
                                <option value="{{ $contrat->direction_id }}" selected>{{ $contrat->direction->name }}
                                </option>
                                @foreach ($directions as $direction)
                                    <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fonction_id">Fonction</label>
                            <select name="fonction_id" id="fonction_id" class="form-control" required>
                                <option value="{{ $contrat->fonction_id }}" selected>{{ $contrat->fonction->name }}
                                </option>
                                @foreach ($fonctions as $fonction)
                                    <option value="{{ $fonction->id }}">{{ $fonction->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="horaire_id">Horaire</label>
                            <select name="horaire_id" id="horaire_id" class="form-control" required>
                                <option value="{{ $contrat->horaire_id }}" selected>{{ $contrat->horaire->name }}
                                </option>
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
@endforeach

