<div wire:ignore.self class="modal fade" id="quick-view" data-price="{{$productPrice}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-4">
                        @forelse ($productImages as $image)
                            @if($image)
                                <img class="img-fluid" src="{{asset('uploads/' . $image)}}">
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <h3>{{$productName}}</h3>
                            <h5>Rp{{number_format($productPrice, thousands_separator:".")}}</h5>
                        </div>
                    </div>
                </div>
            
                <div class="form-group">
                    <h4>Deskripsi Produk</h4>
                    <p>{{$productDesc}}</p>
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <h5><b>Kuantitas:</b></h5>
                        <div class="product-quantity d-flex align-items-center">
                            <div class="product-quantity-group d-flex align-items-center">
                                <button wire:click="decrease" class="btn btn-number text-dark p-2" type="button">
                                        <i class="fas fa-minus"></i>
                                </button>
                                <input wire:model.live="qty" type="text" class="form-control input-number text-center cart-qty-field">
                                <button wire:click="increase" class="btn btn-number text-dark p-2" type="button">
                                        <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <h5>Total Harga : Rp{{number_format($totalPrice, thousands_separator:".")}}</h5>
                </div>
            </div>

            <div class="modal-footer">
                <div class="col-md-12">
                    <center>
                        <button wire:click="addToCart" type="button" class="btn btn-warning">
                            <i class="fas fa-shopping-cart mr-2"></i>Tambah Ke Keranjang
                        </button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>