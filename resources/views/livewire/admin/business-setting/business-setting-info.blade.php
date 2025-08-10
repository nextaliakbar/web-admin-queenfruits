<div>
    <form wire:submit.prevent="update">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Nama Bisnis</label>
                        <input wire:model="name" type="text" class="form-control" id="name" required>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telp">No. Telp</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input wire:model="telp" type="text" class="form-control" placeholder="Masukkan no. telp tanpa angka 0 di depan, misal : 8123456789" required>
                            </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input wire:model="email" type="text" class="form-control" id="email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right">
                        <button wire:click="refresh" type="button" class="btn btn-secondary mr-2">
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
