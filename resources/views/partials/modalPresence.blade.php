<div class="modal fade" id="modalPresence-{{$presence->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail présence de : {{$presence->user->name}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Date : {{ $presence->created_at->format('d-m-Y') }}</p>
          <p>Heure d'arrivée : {{ $presence->heureArrive }}</p>
          <p>Heure de départ : {{ date("H:i:s", strtotime($presence->heureDepart) )}}</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
         
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>