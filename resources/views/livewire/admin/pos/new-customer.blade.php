<div wire:ignore.self class="modal fade" id="newCustomer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pelanggan Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="storeCustomer">
            <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama <span class="text-danger">*</span></label>
                        <input wire:model.live="name" type="text" class="form-control" id="name" placeholder="Masukkan nama pelanggan" required>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="telp">No.telp <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+62</span>
                            </div>
                            <input wire:model="telp" type="number" class="form-control" id="telp" placeholder="Masukkan no. telp tanpa angka 0 di depan, misal : 8123456789" required>
                            @error('telp')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input wire:model.live="email" type="email" class="form-control" id="email" placeholder="Masukkan email pelanggan">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>