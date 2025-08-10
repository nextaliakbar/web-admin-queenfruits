<div wire:ignore.self class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Cabang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row" style="align-items: center;">
                <div class="col md-12">
                    <div class="row">
                        <div class="col-md-3">
                            Nama Cabang
                        </div>
                        <div class="col-md-9">
                            : {{$name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            Email
                        </div>
                        <div class="col-md-9">
                            : {{$email}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            No.telp
                        </div>
                        <div class="col-md-9">
                            : {{$telp}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            Alamat
                        </div>
                        <div class="col-md-9">
                            : {{$address}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-times mr-2"></i>Batal</button>
            <button wire:click="destroy" type="button" class="btn btn-danger">
                <i class="fas fa-trash mr-2"></i>Hapus</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->