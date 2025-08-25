<div>
    <div class="content-wrapper">
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Penjualan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><i class="fas fa-shopping-bag mr-1"></i>Kasir</li>
                <li class="breadcrumb-item">Tambah Penjualan</li>
                </ol>
            </div>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h5>Daftar Produk <span class="badge badge-secondary p-2">{{$branchName}}</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <select wire:model.live="categoryId" class="form-control mb-4 mb-md-0">
                                            <option value="" disabled selected>-- Pilih Kategori --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group input-group-md">
                                            <input wire:model.live="searchProduct" type="text" class="form-control float-right" placeholder="Cari berdasarkan nama produk">
                        
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pos-item-wrap justify-content-center mb-4">
                                    @foreach ($products as $product)
                                    <div wire:click="quickView({{$product->id}})" class="pos-product-item card clickable"
                                        data-toggle="modal" data-target="#quick-view">
                                        <div class="pos-product-item_thumb">
                                            @foreach ($product->images as $image)
                                                @if($image)
                                                <img src="{{asset('uploads/' . $image)}}" class="img-fit">
                                                @break
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="pos-product-item_content">
                                            <div class="pos-product-item_title">
                                                {{$product->name}}
                                            </div>
                                            <div class="pos-product-item_price">
                                                {{$product->branch_product->price}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        {{$products->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h5>Pembayaran</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div wire:ignore class="form-group">
                                            <select class="form-control" id="select-customer">
                                                <option value="" disabled selected>-- Pilih Pelanggan --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <button wire:click="refreshFieldsCustomer" type="button" class="btn btn-md btn-primary w-100" 
                                            data-toggle="modal" data-target="#newCustomer">
                                                <i class="fas fa-plus mr-2"></i> Tambah Pelanggan Baru
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div wire:ignore class="form-group">
                                    <label for="select-branch">Pilih Cabang</label>
                                    <select class="form-control" id="select-branch">
                                        @foreach($branches as $branch)
                                            <option value="{{$branch->id}} {{empty($branchId) 
                                                ? ($branch->id == 1 ? 'selected' : '') 
                                                : ($branch->id == $branchId ? 'selected' : '')}}">
                                                {{$branch->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="select-order-type">Pilih Jenis Pesanan</label>
                                    <div class="form-group clearfix border rounded p-2">
                                        <div class="icheck-primary d-inline mr-4">
                                            <input wire:model.live="orderType" type="radio" name="orderType" id="radioPrimary1" value="Ambil Ditoko">
                                            <label for="radioPrimary1">Ambil Ditoko</label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input wire:model.live="orderType" type="radio" name="orderType" id="radioPrimary2" value="Pengiriman">
                                            <label for="radioPrimary2">Pengiriman</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    @if($orderType == 'Pengiriman')
                                    <div class="d-flex justify-content-between">
                                        <label>Informasi Pengiriman</label>
                                        <div>
                                            <button wire:click="createCustomerAddress" class="btn btn-md">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button wire:click="listDeliveryAddress" class="btn btn-md">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    @if(!empty($customer) && !empty($customer->customer_addresses->where('is_choosen', '=', true)->first()))
                                    @php($customerAddress = $customer->customer_addresses->where('is_choosen', '=', true)->first())
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Penerima</span>
                                                </div>
                                                <div class="col-md-10">
                                                    <span>: {{$customerAddress->contact_person_name}}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>No.telp</span>
                                                </div>
                                                <div class="col-md-10">
                                                    <span>: {{$customerAddress->contact_person_number}}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Alamat</span>
                                                </div>
                                                <div class="col-md-10">
                                                    <span>
                                                        : {{$customerAddress->address}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group border-top"></div>
                                        <div class="form-group">
                                            <a href="https://www.google.com/maps?q={{$customerAddress->latitude}},{{$customerAddress->longitude}}" target="_blank">
                                                <span>
                                                    <i class="fas fa-thumbtack mr-2"></i>
                                                    Buka lokasi di google maps
                                                </span>
                                            </a>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <span class="text-muted">Alamat pengiriman belum diatur</span>
                                        </div>
                                    @endif

                                    @endif

                                    <div class="table-responsive border border-rounded p-2">
                                        <table class="table table-hover">
                                            <tbody>
                                                <thead>
                                                    <tr style="background-color: #f8f9fa;">
                                                        <th>Item</th>
                                                        <th>Kuantitas</th>
                                                        <th>Harga</th>
                                                        <th><i class="fas fa-cog"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse (session()->get('carts', []) as $key => $cart)
                                                    <tr wire:key="{{$key}}">
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <img width="50" height="50" src="{{asset('uploads/'.$cart['image'])}}">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span>{{$cart['name']}}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$cart['qty']}}</td>
                                                        <td>Rp{{number_format($cart['price'], thousands_separator:".")}}</td>
                                                        <td>
                                                            <button wire:click="removeFromCart({{$key}})" type="button" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center text-secondary">
                                                                Tidak ada produk yang ditambahkan ke keranjang
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Pajak / PPN</td>
                                                    <td class="text-right">+ Rp{{number_format($this->items['tax'], thousands_separator:".")}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Diskon</td>
                                                    <td class="text-right">- Rp{{number_format($this->items['discount'], thousands_separator:".")}}</td>
                                                </tr>
                                                <tr>
                                                    <td ><b>Subtotal</b></td>
                                                    <td class="text-right"><b>Rp{{number_format($this->items['subtotal'], thousands_separator:".")}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Pengiriman</td>
                                                    <td class="text-right">
                                                        @if($orderType == 'Pengiriman')
                                                        Rp{{number_format($this->items['deliveryFee'], thousands_separator:".")}}
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr class="border-top" style="background-color: #f8f9fa;">
                                                    <td><h5><b>Total</b></h5></td>
                                                    <td class="text-right"><h5><b>Rp{{number_format($this->items['total'], thousands_separator:".")}}</b></h5></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group">
                                        <label >Sumber Pembayaran</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-4">
                                                <input wire:model="paymentMethod" type="radio" name="paymentMethod" checked id="radioPrimary3" value="Tunai">
                                                <label for="radioPrimary3">Tunai</label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input wire:model="paymentMethod" type="radio" name="paymentMethod" id="radioPrimary4" value="Non Tunai">
                                                <label for="radioPrimary4">Non Tunai</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-md btn-secondary w-100 mr-4">
                                                <i class="fas fa-times mr-2"></i>
                                                Atur Ulang
                                            </button>
                                            <button wire:click="makeSale" type="button" class="btn btn-md btn-primary w-100">
                                                <i class="fas fa-plus mr-2 "></i>
                                                Buat Penjualan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('livewire.admin.pos.new-customer')

        @include('livewire.admin.pos.new-customer-address')

        @include('livewire.admin.pos.setting-delivery-address')

        @include('livewire.admin.pos.quick-view')

        @script
            <script>
                $wire.on('toastCreateCustomer', (evt)=> {
                    $('#newCustomer').modal('hide');
                    if(evt.success) {
                        toastr.success(evt.message);
                    } else {
                        toastr.error(evt.message);
                    }
                });

                $wire.on('toastValidateFail', (evt)=> {
                    toastr.error(evt.message);
                });

                $wire.on('toastCreateOrder', (evt)=> {
                    if(evt.success) {
                        toastr.success(evt.message);
                    } else {
                        toastr.error(evt.message);
                    }
                });

                $wire.on('showNewCustomerAddressModal', () => {
                    $('#newCustomerAddress').modal('show');
                });

                $wire.on('toastCreateCustomerAddress', (evt)=> {
                    $('#newCustomerAddress').modal('hide');
                    if(evt.success) {
                        toastr.success(evt.message);
                    } else {
                        toastr.error(evt.message);
                    }
                });
                
                $wire.on('showListDeliveryAddressModal', ()=> {
                    $('#listDeliveryAddress').modal('show');
                });

                $wire.on('toastSetDeliveryAddress', (evt)=> {
                    $('#listDeliveryAddress').modal('hide');
                    if(evt.success) {
                        toastr.success(evt.message);
                    } else {
                        toastr.error(evt.message);
                    }
                });

                $wire.on('closeQuickViewModal', ()=> {
                    $('#quick-view').modal('hide');
                });
                
            </script>
        @endscript
    </div>
</div>

@push('scripts')
<script>
    'use-strict';
    
    document.addEventListener('livewire:navigated', ()=> {
        $('#select-customer').select2({
            theme: "bootstrap4",
            width: '100%',
            ajax: {
                url: '{{route("admin.pos.search-customer")}}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchCustomer: params.term,
                    }
                },
                processResults: function(data) {
                    return {
                        results: data
                    }
                },
                cache: true
            }
        }); 

        $('#select-branch').select2({
            theme: "bootstrap4",
            width: '100%',
            ajax: {
                url: '{{route("admin.pos.search-branch")}}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchBranch: params.term,
                    }
                },
                processResults: function(data) {
                    return {
                        results: data
                    }
                },
                cache: true
            }
        });

        $('#select-customer').on('change', function (e) {
            var data = $(this).val();
            Livewire.dispatch('customerSelected', {customerId: data});
        });

        $('#select-branch').on('change', function (e) {
            var data = $(this).val();
            Livewire.dispatch('branchSelected', {branchId: data});
        });
    });
</script>

<script>
    function initMap() {
        const initialLocation = { lat: -8.17668081629412, lng: 113.7121474542403 };

        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: initialLocation
        });

        const marker = new google.maps.Marker({
            position: initialLocation,
            map: map,
            draggable: true
        });

        map.addListener('click', (mapsMouseEvent) => {
            const coords = mapsMouseEvent.latLng;
            marker.setPosition(coords);

            @this.set('lat', coords.lat());
            @this.set('lng', coords.lng());
        });

        marker.addListener('dragend', function(mapsMouseEvent) {
            const coords = mapsMouseEvent.latLng;
            marker.setPosition(coords);

            @this.set('lat', coords.lat());
            @this.set('lng', coords.lng());
        });
    }

    document.addEventListener('livewire:navigated', () => {
        if(window.google && window.google.maps) {
            initMap();
        }
    });
</script>
    
<script wire:navigate async src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API')}}&callback=initMap"></script>

@endpush
