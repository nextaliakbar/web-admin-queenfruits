  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{asset('index3.html')}}" class="brand-link">
      <img src="{{asset('assets/image/logo_store_2.png')}}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SUPER ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Kasir
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Pesanan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">MANAJEMEN PESANAN</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Verifikasi Pembayaran
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Pesanan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua<span class="badge badge-info right">2</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tertunda<span class="badge badge-secondary right">2</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dikonfirmasi<span class="badge badge-primary right">2</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Diproses<span class="badge badge-dark right">2</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengiriman<span class="badge badge-warning right">2</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Terkirim<span class="badge badge-success right">2</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dibatalkan<span class="badge badge-danger right">2</span></p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">MANAJEMEN PRODUK</li>

          <li class="nav-item">
            <a wire:navigate href="{{route('admin.category.index')}}" class="nav-link {{request()->routeIs('admin.category.index') ? 'active' : ''}}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Kategori Produk
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="javascript:" class="nav-link {{request()->routeIs('admin.product.*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-gem"></i>
              <p>
                Pengaturan Produk
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a wire:navigate href="{{route('admin.product.add')}}" class="nav-link {{request()->routeIs('admin.product.add') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a wire:navigate href="{{route('admin.product.index')}}" class="nav-link {{request()->routeIs('admin.product.index') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Review Produk</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">MANAJEMEN PROMOSI</li>
          
          <li class="nav-item">
            <a wire:navigate href="{{route('admin.banner.index')}}" class="nav-link {{request()->routeIs('admin.banner.index') ? 'active' : ''}}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Banner
              </p>
            </a>
          </li>

          <li class="nav-header">MANAJEMEN PENGGUNA</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pelanggan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Kurir
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Kurir</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Kurir</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Review Kurir</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">MANAJEMEN SISTEM</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Pengaturan Bisnis
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-store"></i>
              <p>
                Cabang Bisnis
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Cabang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Cabang</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>