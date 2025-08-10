<div wire:ignore.self class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Perbarui Waktu Operasional Hari {{$day}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form wire:submit.prevent="update">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="openingTime">Mulai</label>
                            <input wire:model="openingTime" type="time" class="form-control" id="openingTime" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="closingTime">Sampai</label>
                            <input wire:model="closingTime" type="time" class="form-control" id="closingTime" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="mt-3 mb-0"><b>Catatan :</b></p>
                            <p class="text-muted medium mb-0">AM = Dimulai dari pukul 00:00 hingga 11:59</p>
                            <p class="text-muted medium mb-0">PM = Dimulai dari pukul 12:00 hingga 23:59</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Simpan</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->