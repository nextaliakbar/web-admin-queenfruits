<div wire:ignore.self class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Banner</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img width="350" height="175" src="{{asset("uploads/$existBannerImage")}}" alt="image">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        Judul Banner : {{$bannerTitle}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        Jenis Banner
                        @if($categoryId)
                        : Banner Untuk Kategori Produk 
                        ({{App\Models\Category::where('id', '=', $categoryId)->value('name') ?? 'Kategori produk tidak tersedia'}})
                        @elseif($productId)
                        : Banner Untuk Produk
                        ({{App\Models\Product::where('id', '=', $productId)->value('name') ?? 'Produk tidak tersedia'}})
                        @endif
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