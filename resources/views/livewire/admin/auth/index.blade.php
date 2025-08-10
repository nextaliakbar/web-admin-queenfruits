<div>
  
  <div class="login-box">
  <div class="login-logo">
      <h3>SUPER ADMIN</h3>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <form wire:submit.prevent="login">
        <div class="input-group mb-3">
          <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror" 
          placeholder="Masukkan email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
          @error('email')
            <div class="mb-3">
                <span class="text-danger">{{$message}}</span>
            </div>
          @enderror
        <div class="input-group mb-3">
          <input wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" 
          placeholder="Masukkan password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          @error('password')
            <div class="mb-3">
                <span class="text-danger">{{$message}}</span>
            </div>
          @enderror
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="mt-3">
        <h5 class="text-center">
          <a href="#" class="text-dark"><i class="fas fa-arrow-left mr-2"></i>Masuk Ke Cabang Lain</a>
        </h5>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
  
  <!-- Error if login invalid start-->
    @script
      <script>
        $wire.on('errorModal', ()=> {
          toastr.error('Email atau Password Salah')
        });
      </script>
    @endscript
  <!-- Error if login invalid end-->
</div>

</div>
