<div>
    <form wire:submit.prevent="update">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="minOrder">Minimal Pemesanan (Rp)</label>
                        <input wire:model="minOrder" type="number" class="form-control" id="minOrder" placeholder="Masukkan hanya angka, Misal : 10" required>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="timeSlot">Slot Waktu Pengiriman (Menit)</label>
                        <input wire:model="timeSlot" type="number" class="form-control" id="timeSlot" placeholder="Masukkan hanya angka, Misal : 60" required>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary mr-2">
                            <i class="fas fa-times mr-2"></i>Atur Ulang
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @script
        <script>
            $wire.on('toastUpdate', (evt)=> {
                if(evt.success) {
                    toastr.success(evt.message);
                } else {
                    toastr.error(evt.message);
                }
            });
        </script>
    @endscript
</div>
