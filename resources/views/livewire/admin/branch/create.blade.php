<div>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Cabang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-store mr-1"></i>Cabang Bisnis</li>
              <li class="breadcrumb-item">Tambah Cabang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <form wire:submit.prevent="store">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Nama Cabang <span class="text-danger">*</span></label>
                                <input wire:model="name" type="text" class="form-control" id="name" placeholder="Misal : Cabang 2" required>
                            </div>
                            <div class="form-group">
                                <label for="telp">No. Telp <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+62</span>
                                    </div>
                                    <input wire:model="telp" type="text" class="form-control" placeholder="Masukkan no. telp tanpa angka 0 di depan, misal : 8123456789" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input wire:model="email" type="email" class="form-control" id="email" placeholder="Misal : cabang2@example.com" required>
                            </div>
                            @error('email')
                                <div class="form-group">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="preparationTime">Waktu Persiapan Pesanan (Menit) <span class="text-danger">*</span></label>
                                <input wire:model="preparationTime" type="number" class="form-control" id="preparationTime" placeholder="Masukkan hanya angka, Misal : 30" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input wire:model="password" type="password" class="form-control" id="password" placeholder="8+ karakter" required>
                            </div>
                            @error('password')
                                <div class="form-group">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="passwordConfirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input wire:model="passwordConfirmation" type="password" class="form-control" id="passwordConfirmation" placeholder="8+ karakter" required>
                            </div>
                            @error('passwordConfirmation')
                                <div class="form-group">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Foto Cabang <span class="text-danger">* (Rasio 2:1)</span></label>
                                <input wire:model.live="branchImage" type="file" id="image1" class="d-none" accept=".png, .jpg, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                <label for="image1" class="d-flex justify-content-center align-items-center" 
                                style="cursor: pointer; border-radius: .25rem;">
                                    <div wire:loading wire:target="branchImage">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    </div>

                                    <div wire:loading.remove wire:target="branchImage">
                                        @if($branchImage)
                                            <img class="img-fluid rounded" src="{{$branchImage->temporaryUrl()}}" alt="Gambar Cabang">
                                        @else
                                            <img class="img-fluid rounded" src="{{asset('assets/image/img1.jpg')}}" alt="Gambar Cabang">
                                        @endif
                                    </div>
                                </label>
                            </div>
                            @error('branchImage')
                                <div class="form-group">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="address">Alamat <span class="text-danger">*</span></label>
                                <textarea wire:model="address" id="address" class="form-control"required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-location-arrow"></i> Lokasi Cabang</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lat">Latitude <span class="text-danger">*</span></label>
                                <input wire:model.live="lat" type="text" class="form-control" id="lat" required>
                            </div>
                            <div class="form-group">
                                <label for="lng">Longitude <span class="text-danger">*</span></label>
                                <input wire:model.live="lng" type="text" class="form-control" id="lng" required>
                            </div>
                            <div class="form-group">
                                <label for="coverage">Cakupan Radius (Km) <span class="text-danger">*</span></label>
                                <input wire:model="coverage" type="number" class="form-control" id="coverage" placeholder="Masukkan hanya angka, Misal : 10" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div wire:ignore id="map" style="height: 245px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right">
                        <button wire:click="refresh" type="button" class="btn btn-secondary mr-2">
                            Atur Ulang
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
          </form>
      </div>
    </section>
    <!-- /.content -->
    @script
    <script>
        'use-strict';

        $wire.on('toastCreateBranch', (evt)=> {
            toastr.error(evt.message);
        });

    </script>
    @endscript
  </div>
  <!-- /.content-wrapper -->
</div>
@push('scripts')
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
