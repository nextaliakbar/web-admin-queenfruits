<div wire:ignore.self class="modal fade" id="newCustomerAddress">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Alamat Pengiriman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="storeCustomerAddress">
            <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contactPersonName">Nama Penerima</label>
                                <input wire:model="contactPersonName" type="text" class="form-control" id="contactPersonName" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contactPersonNumber">No.telp <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+62</span>
                                    </div>
                                    <input wire:model="contactPersonNumber" type="number" class="form-control" id="contactPersonNumber" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="address">Alamat <span class="text-danger">*</span></label>
                        <textarea wire:model="address" rows="5" class="form-control"></textarea>
                        @error('address')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lat">Latitude <span class="text-danger">*</span></label>
                                <input wire:model="lat" type="text" class="form-control" id="lat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lng">Longitude <span class="text-danger">*</span></label>
                                <input wire:model="lng" type="text" class="form-control" id="lng" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div wire:ignore id="map" style="height: 245px; width: 100%;"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="d-flex justify-content-between">
                        <button wire:click="refreshFieldsCustomerAddress" type="button" class="btn btn-secondary mr-2" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>