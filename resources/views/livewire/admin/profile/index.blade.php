<div>
   <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Beranda</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4><i class="fas fa-user"></i> Informasi Profil</h4>
              </div>
              <div class="card-body">
                <form wire:submit.prevent="updateProfile" class="form-horizontal">
                  <div class="form-group row">
                      <label for="name" class="col-sm-2 col-form-label">Nama</label>
                      <div class="col-sm-10">
                          <input wire:model="name" type="text" class="form-control" id="name" placeholder="Masukkan nama" required>
                          @error('name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="telp" class="col-sm-2 col-form-label">No. Telp</label>
                      <div class="col-sm-10">
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
                  </div>
                  <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                          <input wire:model="email" type="email" class="form-control" id="email" placeholder="Masukkan email" required>
                          @error('email')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row float-right">
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h4><i class="fas fa-lock"></i> Ubah Password</h4>
              </div>
              <div class="card-body">
                <form wire:submit.prevent="updatePassword" class="form-horizontal">
                  <div class="form-group row">
                      <label for="password" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                          <input wire:model="password" type="password" class="form-control" id="password" placeholder="8+ karakter" required>
                          @error('password')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="passwordConfirmation" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                      <div class="col-sm-10">
                          <input wire:model="passwordConfirmation" type="password" class="form-control" id="passwordConfirmation" placeholder="8+ karakter" required>
                          @error('passwordConfirmation')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row float-right">
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    @script
      <script>
        $wire.on('toastUpdateProfile', (evt)=> {
          if(evt.success) {
            toastr.success(evt.message);
          } else {
            toastr.error(evt.message);
          }
        });

        $wire.on('toastUpdatePassword', (evt)=> {
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
