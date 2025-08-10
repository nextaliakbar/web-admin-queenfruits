<div wire:ignore.self class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Kategori</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row" style="align-items: center;">
                <div class="col-sm-3">
                    <img width="85" height="85" src="{{$existCategoryFile ? asset("uploads/$existCategoryFile") 
                    : asset("assets/image/img2.jpg")}}" alt="image">
                </div>
                <div class="col-sm-4">Nama Kategori</div>
                <div class="col-sm-5">: {{$categoryName}}</div>
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