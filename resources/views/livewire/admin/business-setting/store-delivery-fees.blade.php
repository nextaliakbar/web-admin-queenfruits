<div>
    <div class="card-body">
        <form wire:submit.prevent="update">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Biaya Pengiriman Tetap</label>
                            </div>
                            <div class="form-group">
                                <p>Siapkan biaya pengiriman tetap yang ingin anda kirim dari lokasi toko</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input wire:model.live="isFixedCharge" type="checkbox"
                                    class="custom-control-input" id="switcher-control-1">
                                    <label class="custom-control-label" for="switcher-control-1"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            @if($isFixedCharge)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="charge">Biaya</label>
                                <input wire:model="fixedCharge" type="number" class="form-control" id="charge"
                                placeholder="Masukkan hanya angka, Misal : 7000" required>
                                @error('fixedCharge')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <button wire:click="getData({{$branchId}})" type="button" class="btn btn-secondary mr-2">
                                    <i class="fas fa-times mr-2"></i>Atur Ulang
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-2"></i>Simpan
                                </button>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
    
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Biaya Pengiriman Per Km</label>
                            </div>
                            <div class="form-group">
                                <p>Atur biaya pengiriman per km dan seberapa jauh anda ingin mengirim dari lokasi toko</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input wire:model.live="isPerKmCharge" type="checkbox"
                                    class="custom-control-input" id="switcher-control-2">
                                    <label class="custom-control-label" for="switcher-control-2"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            @if($isPerKmCharge)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="chargePerKm">Biaya Per Km</label>
                                <input wire:model="chargePerKm" type="number" class="form-control" id="chargePerKm" placeholder="Masukkan hanya angka, Misal : 7000" required>
                                @error('chargePerKm')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="minimumCharge">Minimal Biaya Pengiriman</label>
                                <input wire:model="minCharge" type="number" class="form-control" id="minimumCharge" placeholder="Masukkan hanya angka, Misal : 7000" required>
                                @error('minCharge')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="maxKmForFreeDelivery">Maksimal Jarak Untuk Pengiriman Gratis (Km)</label>
                                <input wire:model="maxKmForFreeDelivery" type="number" class="form-control" id="maxKmForFreeDelivery" placeholder="Masukkan hanya angka, Misal : 8" required>
                                @error('maxKmForFreeDelivery')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <button wire:click="getData({{$branchId}})" type="button" class="btn btn-secondary mr-2">
                                    <i class="fas fa-times mr-2"></i>Atur Ulang
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-2"></i>Simpan
                                </button>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </form>

        @script
            <script>
                $wire.on('toastUpdateDeliveryChargeType', (evt)=> {
                    if(evt.success) {
                        toastr.success(evt.message);
                    } else {
                        toastr.error(evt.message);
                    }
                });

                $wire.on('toastUpdateDeliveryCharge', (evt)=> {
                    if(evt.success) {
                        toastr.success(evt.message);
                    } else {
                        toastr.error(evt.message);
                    }
                });    
            </script>
        @endscript
    </div>
</div>
