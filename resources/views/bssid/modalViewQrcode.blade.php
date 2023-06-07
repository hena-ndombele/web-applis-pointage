 <!-- .modal -->
 <div class="modal fade" id="modal-lg-{{$item->id}}">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Code QR du wifi : {{$item->name}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <p><img id="image" src="{{ asset('storage/' . $item->qr_code)  }}" alt="{{$item->name}}"></p>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-primary">Fermer</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->