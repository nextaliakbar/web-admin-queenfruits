<div wire:ignore.self class="modal fade" id="listDeliveryAddress">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Alamat Pengiriman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @php($customerAddresses = App\Models\CustomerAddress::where('user_id', '=', $customerId)
                ->orderByDesc('is_choosen')->paginate(3, ['*'], 'addressPage'))
                @forelse ($customerAddresses as $customerAddress)
                    <div wire:click="setDeliveryAddress({{$customerAddress->id}})" class="row clickable">
                        <div class="col-md-12">
                            <div class="card border border-rounded {{$customerAddress->is_choosen ? 'border-primary' : ''}}">
                                <div class="card-body">
                                    <label><i class="fas fa-home mr-2"></i>{{$customerAddress->address_type}}</label>
                                    <div class="form-group">
                                        <span class="text-dark">
                                            {{$customerAddress->address}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="form-group">
                    <span class="text-muted">Tidak ada alamat yang tersedia untuk pelanggan ini</span>
                </div>
                @endforelse
                <div class="form-group">
                    {{$customerAddresses->links()}}
                </div>
            </div>
        </div>
    </div>
</div>