<div>
    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{asset('assets/image/user.png')}}" class="user-image img-circle" alt="User Image">
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header">
            <img src="{{asset('assets/image/user.png')}}" class="img-circle" alt="User Image">
            <p>
              {{auth()->guard('admin')->user()->name}}
            </p>
            <span class="badge badge-success">{{auth()->guard('admin')->user()->role->name}}</span>
          </li>

          <!-- Menu Footer-->
          <li class="user-footer">
            <a wire:navigate href="{{route('admin.profile.index')}}" class="btn btn-default btn-flat">
              <i class="fas fa-user mr-1"></i>Profil
            </a>
            <button type="button" class="btn btn-danger btn-flat float-right" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt mr-1"></i>Keluar
            </button>
          </li>

        </ul>
      </li>
    </ul>
  </nav>
  <div wire:ignore.self class="modal fade" id="logoutModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title mb-2">Anda yakin ingin keluar?</h4>
            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Tidak</button>
            <button wire:click="logout" type="button" class="btn btn-danger">Ya</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!-- /.navbar -->
</div>
