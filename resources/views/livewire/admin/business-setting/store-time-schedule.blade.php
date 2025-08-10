<div>
    <div class="card-body">
    @foreach ($schedules as $schedule)
        <div class="row align-items-center mb-3 pb-3 border-bottom">

            <div class="col-12 col-md-2 mb-2 mb-md-0">
                <strong>{{ $schedule['day'] }}</strong>
            </div>

            <div class="col-10 col-md-8">
                @if (empty($schedule['data']))
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="border border-danger rounded px-3 py-2">
                                <p class="text-danger m-0">Libur</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-2 mb-sm-0">
                            <div class="border rounded p-2">
                                <p class="text-muted d-block small mb-1">Waktu Buka</p>
                                <input type="text" class="form-control-plaintext p-0" value="{{ \Carbon\Carbon::parse($schedule['data']->opening_time)->format('H:i') }}">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="border rounded p-2">
                                <p class="text-muted d-block small mb-1">Waktu Tutup</p>
                                <input type="text" class="form-control-plaintext p-0" value="{{ \Carbon\Carbon::parse($schedule['data']->closing_time)->format('H:i') }}">
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-2 col-md-2 text-right">
                @if (empty($schedule['data']))
                    <button wire:click="edit('{{ $schedule['day'] }}')" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">
                        <i class="fas fa-plus"></i>
                    </button>
                @else
                    <button wire:click="destroy({{ $schedule['id'] }})" type="button" class="btn btn-danger btn-sm">
                        <i class="fas fa-times"></i>
                    </button>
                @endif
            </div>

        </div>
    @endforeach
</div>
    
    @include('livewire.admin.business-setting.partials.edit-store-time-schedule')

    @script
        <script>
            $wire.on('toastUpdate', (evt)=> {
                $('#editModal').modal('hide');
                if(evt.success) {
                    toastr.success(evt.message);
                } else {
                    toastr.error(evt.message);
                }
            });
        </script>
    @endscript
</div>
