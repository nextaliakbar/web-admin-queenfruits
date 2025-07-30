<div wire:ignore.self class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Produk</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row" style="align-items: center;">
                <div class="col-sm-3">
                    @if(isset($productImages[0]))
                        <img width="85" height="85" src="{{asset('uploads/' . $productImages[0])}}" alt="image">
                    @elseif(isset($productImages[1]))
                        <img width="85" height="85" src="{{asset('uploads/' . $productImages[1])}}" alt="image">
                    @elseif(isset($productImages[2]))
                        <img width="85" height="85" src="{{asset('uploads/' . $productImages[2])}}" alt="image">
                    @endif
                </div>
                <div class="col sm-9">
                    <div class="row">
                        <div class="col-sm-4">
                            Nama Produk
                        </div>
                        <div class="col-sm-8">
                            : {{$name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            Harga Jual
                        </div>
                        <div class="col-sm-8">
                            : Rp{{number_format($price, thousands_separator: ",")}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            Total Penjualan
                        </div>
                        <div class="col-sm-8">
                            : {{$totalSale}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            Stok
                        </div>
                        <div class="col-sm-8">
                            : {{$stock}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-times mr-2"></i>Batal</button>
            <button wire:click="destroy({{$productId}})" type="button" class="btn btn-danger">
                <i class="fas fa-trash mr-2"></i>Hapus</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->