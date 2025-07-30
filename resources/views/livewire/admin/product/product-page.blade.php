<div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa"></i>Daftar Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-gem mr-1"></i>Pengaturan Produk</a></li>
              <li class="breadcrumb-item active">Daftar Produk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="col-md-12">
            <div class="card">
              <!-- card-header -->
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <div>
                    <a wire:navigate href="{{route('admin.product.add')}}">
                      <button class="btn btn-md btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                      </button>
                    </a>
                  </div>
                  <div class="col-md-4 card-tools">
                    <div class="input-group input-group-md">
                      <input wire:model.live="search" type="text" class="form-control float-right" placeholder="Cari berdasarkan nama kategori">
  
                      <div class="input-group-append">
                        <button type="button" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->

              <!-- card-body -->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Harga Jual</th>
                        <th>Total Penjualan</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Rekomendasi</th>
                        <th><i class="fas fa-cog"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $product)
                      <tr wire:key="{{$product->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-3">
                              @if(isset($product->images[0]))
                                <img width="50" height="50" src="{{asset('uploads/' . $product->images[0])}}" alt="image">
                              @elseif(isset($product->images[1]))
                                <img width="50" height="50" src="{{asset('uploads/' . $product->images[1])}}" alt="image">
                              @elseif(isset($product->images[2]))
                                <img width="50" height="50" src="{{asset('uploads/' . $product->images[2])}}" alt="image">
                              @endif
                            </div>
                            <div class="col-md-9">
                              {{$product->name}}
                            </div>
                          </div>
                        </td>
                        <td>Rp{{number_format($product->price, thousands_separator: ".")}}</td>
                        <td>10</td>
                        <td>
                          <div class="row">
                            <div class="col-md-5">
                              Jenis Stok
                            </div>
                            <div class="col-md-7">
                              : {{$product->stock_type}}
                            </div>
                          </div>
                          @if($product->stock_type == 'Tetap')
                          <div class="row">
                            <div class="col-md-5">
                              Jumlah Stok
                            </div>
                            <div class="col-md-7">
                              : {{$product->stock}}
                            </div>
                          </div>
                          @endif
                        </td>
                        <td>
                          <div class="custom-control custom-switch">
                            <input wire:click="updateStatus({{$product->id}})" type="checkbox" class="custom-control-input" 
                            id="statusControll-{{$product->id}}" {{$product->is_active == 1 ? 'checked' : ''}}>
                            <label class="custom-control-label" for="statusControll-{{$product->id}}"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-switch">
                            <input wire:click="updateRecommend({{$product->id}})" type="checkbox" class="custom-control-input" 
                            id="recommendControll-{{$product->id}}" {{$product->is_recommend == 1 ? 'checked' : ''}}>
                            <label class="custom-control-label" for="recommendControll-{{$product->id}}"></label>
                          </div>
                        </td>
                        <td>
                          <a wire:navigate href="{{route('admin.product.edit', ['productId' => $product->id])}}">
                            <button type="button" class="btn btn-sm btn-warning mr-1">
                              <i class="fas fa-edit"></i>
                            </button>
                          </a>
                          <button wire:click="confirm({{$product->id}})" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{$products->links()}}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
    </section>
    <!-- /.content -->

    @include('livewire.admin.product.delete')

    @script
      <script>
        $wire.on('toastUpdateStatus', (evt)=> {
          if(evt.success) {
            toastr.success(evt.message);
          } else {
            toastr.error(evt.message);
          }
        });

        $wire.on('toastUpdateRecommend', (evt)=> {
          if(evt.success) {
            toastr.success(evt.message);
          } else {
            toastr.error(evt.message);
          }
        });

        $wire.on('toastDeleteProduct', (evt)=> {
          $('#deleteModal').modal('hide');
          if(evt.success) {
            toastr.success(evt.message);
          } else {
            toastr.error(evt.message);
          }
        });
      </script>
    @endscript
  </div>
  <!-- /.content-wrapper -->
</div>
