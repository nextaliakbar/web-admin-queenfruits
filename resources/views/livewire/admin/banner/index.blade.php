<div>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa"></i>Tambah Banner Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="far fa-image mr-1"></i>Banner</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <form wire:submit.prevent='{{$isEditMode ? "update($bannerId)" : "store"}}'>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="title">Judul Banner <span class="text-danger">*</span></label>
                          <input wire:model="title" type="text" class="form-control" id="title" placeholder="Misal : Buah Fresh" required>
                        </div>
                        <div class="form-group">
                          <select wire:model.live="bannerType" class="form-control" required>
                              <option value="" selected>-- Pilih Jenis Banner --</option>
                              <option value="Banner Untuk Kategori Produk" selected>-- Banner Untuk Kategori Produk --</option>
                              <option value="Banner Untuk Produk" selected>-- Banner Untuk Produk --</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <select wire:model="{{$bannerType == 'Banner Untuk Kategori Produk' ? 'categoryId'
                          : ($bannerType == 'Banner Untuk Produk' ? 'productId' : '')}}" 
                          wire:key="bannerType" class="form-control" required>
                            <option value="" selected>-- {{$bannerType == 'Banner Untuk Kategori Produk' ? 'Kategori Produk'
                            : ($bannerType == 'Banner Untuk Produk' ? 'Produk' : 'Tentukan Jenis Banner')}} --</option>
                            @if($bannerType == 'Banner Untuk Kategori Produk')
                              @if($isEditMode)
                                @forelse (App\Models\Category::whereStatus(true)->get() as $category)
                                  <option value="{{$category->id}}" {{$categoryId == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                @empty
                                  <option value="">-- Kategori Produk Tidak Tersedia --</option>
                                @endforelse
                              @else
                                @forelse ($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                                @empty
                                  <option value="">-- Kategori Produk Tidak Tersedia --</option>
                                @endforelse
                              @endif
                            @elseif ($bannerType == 'Banner Untuk Produk')
                              @if($isEditMode)
                                @forelse (App\Models\Product::whereIsActive(true)->get() as $product)
                                  <option value="{{$product->id}}" {{$productId == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
                                @empty
                                  <option value="">-- Produk Tidak Tersedia --</option>
                                @endforelse
                              @else
                                @forelse ($products as $product)
                                  <option value="{{$product->id}}">{{$product->name}}</option>
                                @empty
                                  <option value="">-- Produk Tidak Tersedia --</option>
                                @endforelse
                              @endif
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="bannerImage">Gambar Banner <span class="text-danger">* Rasio (2:1)</span></label>
                          <div class="col-md-8 text-center">
                              <input wire:model.live="bannerImage" type="file" id="image1" class="d-none" accept=".png, .jpg, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                              <label for="image1" class="d-flex justify-content-center align-items-center" 
                              style="cursor: pointer; border-radius: .25rem;">
                                  <div wire:loading wire:target="bannerImage">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                  </div>
  
                                  <div wire:loading.remove wire:target="bannerImage">
                                      @if(!empty($bannerImage))
                                        <img class="img-fluid rounded" src="{{$bannerImage->temporaryUrl()}}" alt="Upload Gambar 1">
                                      @elseif(!empty($existingBannerImage))
                                        <img class="img-fluid rounded" src="{{ asset("uploads/$existingBannerImage") }}" alt="Upload Gambar 1">
                                      @else
                                        <img class="img-fluid rounded" src="{{ asset('assets/image/img1.jpg') }}" alt="Upload Gambar 1">
                                      @endif
                                  </div>
                              </label>
                            </div>
                            @error('bannerImage')
                              <div class="row">
                                <div class="col-md-12">
                                  <span class="text-danger">{{$message}}</span>
                                </div>
                              </div>
                            @enderror
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="card-footer">
                    <div class="float-right">
                        <button wire:click="refresh" type="button" class="btn btn-secondary mr-2"><i class="fas fa-times mr-2"></i>Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
            <div class="card">
              <!-- card-header -->
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <div>
                    <h3 class="card-title">Daftar Banner</h3>
                  </div>
                  <div class="col-md-4 card-tools">
                    <div class="input-group input-group-md">
                      <input wire:model.live="search" type="text" class="form-control float-right" placeholder="Cari berdasarkan judul banner">
  
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
                        <th>Gambar Banner</th>
                        <th>Judul Banner</th>
                        <th>Jenis Banner</th>
                        <th>Status</th>
                        <th><i class="fas fa-cog"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($banners as $banner)
                      <tr wire:key="{{$banner->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td>
                          <img width="100" height="50" src="{{$banner->image ? asset("uploads/$banner->image") : asset('assets/image/img2.jpg')}}" alt="image">
                        </td>
                        <td>{{$banner->title}}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-5">
                              @if(!empty($banner->category_id))
                              Banner Untuk Kategori Produk
                              @elseif(!empty($banner->product_id))
                              Banner Untuk Produk
                              @endif
                            </div>
                            <div class="col-md-7">
                              @if(!empty($banner->category_id))
                              : {{App\Models\Category::where('id', '=', $banner->category_id)->value('name') ?? 'Kategori produk tidak tersedia'}}
                              @elseif(!empty($banner->product_id))
                              : {{App\Models\Product::where('id', '=', $banner->product_id)->value('name') ?? 'Produk tidak tersedia'}}
                              @endif
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-switch">
                            <input wire:click="updateStatus({{$banner->id}})" type="checkbox" class="custom-control-input" 
                            id="customSwitch-{{$banner->id}}" {{$banner->status == 1 ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customSwitch-{{$banner->id}}"></label>
                          </div>
                        </td>
                        <td>
                          <button wire:click="edit({{$banner->id}})" type="button" class="btn btn-sm btn-warning mr-1 mb-2 mb-md-0">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button wire:click="confirm({{$banner->id}})" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      @empty
                        <tr>
                          <td colspan="6" class="text-center text-secondary">
                            <h5>Tidak ada data yang tersedia</h5>
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                  {{$banners->links()}}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
          </div>
        </div>
    </section>
    <!-- /.content -->

    @script
    <script>
      'use-strict';

      $wire.on('toastCreateBanner', (evt)=> {
        if(evt.success) {
          toastr.success(evt.message);
        } else {
          toastr.error(evt.message);
        }
      });
      
      $wire.on('toastUpdateStatus', (evt)=> {
        if(evt.success) {
          toastr.success(evt.message);
        } else {
          toastr.error(evt.message);
        }
      });

      $wire.on('toastUpdateBanner', (evt)=> {
        if(evt.success) {
          toastr.success(evt.message);
        } else {
          toastr.error(evt.message);
        }
      });

      $wire.on('toastDeleteBanner', (evt)=> {
        $('#deleteModal').modal('hide');
        if(evt.success) {
          toastr.success(evt.message);
        } else {
          toastr.error(evt.message);
        }
      });
    </script>
    @endscript
    <!-- /.content-wrapper -->

    <!-- delete modal -->
      @include('livewire.admin.banner.delete')
    <!-- ./delete modal -->
  </div>
</div>
