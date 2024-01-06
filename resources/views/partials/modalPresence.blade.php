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
          <?php
              // Définir la plage de dates du mois sélectionné
              $month_start = Carbon\Carbon::parse($date)->startOfMonth();
              $month_end = Carbon\Carbon::parse($date)->endOfMonth();

            // Compter le nombre total des présences pour le mois sélectionné
            $countPresence = App\Models\Presence::where('user_id', $presence->user_id)
                            ->where('status', 1)
                            ->whereBetween('created_at', [$month_start, $month_end])
                            ->count();

            // Compter le nombre total des absences pour le mois sélectionné
            $countAbsence = App\Models\Presence::where('user_id', $presence->user_id)
                            ->where('status', 0)
                            ->whereBetween('created_at', [$month_start, $month_end])
                            ->count();

          
           // Définir la langue locale sur "fr" (français)
           Carbon\Carbon::setLocale('fr');

          // Récupérer le mois à partir de la date
          $month = Carbon\Carbon::parse($date)->format('F');

          ?>
        <h4>Mois de : {{ $month}}</h4>
        <p> Total  présences : <button class="btn btn-success">{{  $countPresence }}</button> </p>
        <p> Total absences  : <button class="btn btn-danger">{{  $countAbsence }}</button></p>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
       
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>  