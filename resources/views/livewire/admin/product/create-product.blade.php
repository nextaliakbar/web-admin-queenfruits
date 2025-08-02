<div>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa"></i>Tambah Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-gem mr-1"></i>Pengaturan Produk</a></li>
              <li class="breadcrumb-item active">Tambah Produk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <form wire:submit.prevent="store">
              <div class="row">
                  <div class="col-md-6">
                      <div class="card">
                          <div class="card-body">
                              <div class="form-group">
                                  <label for="name">Nama</label>
                                  <input wire:model="name" type="text" class="form-control" id="name" placeholder="Misal : Salad Buah 500gr" required>
                              </div>
                              <div class="form-group">
                                  <label for="description">Deskripsi</label>
                                  <textarea wire:model="description" class="form-control" rows="3" id="description" placeholder="Enter ..."></textarea>
                              </div>
                          </div>
                      </div>

                      <div class="card">
                          <div class="card-header">
                              <h5><i class="fas fa-sitemap mr-2"></i>Kategori Produk</h5>
                          </div>
                          <div class="card-body">
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <select wire:model="categoryId" class="form-control" required>
                                              <option value="" selected>-- Pilih Kategori Produk --</option>
                                              @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>                                                
                                              @endforeach
                                          </select>
                                      </div>
                                      <div class="col-md-6">
                                          <select wire:model="productType" class="form-control" required>
                                              <option value="" selected>-- Pilih Jenis Produk --</option>
                                              <option value="Produk Lokal" selected>-- Produk Lokal --</option>
                                              <option value="Produk Impor" selected>-- Produk Impor --</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="card">
                          <div class="card-header">
                              <h5><i class="fas fa-money-bill mr-2"></i>Informasi Harga</h5>
                          </div>
                          <div class="card-body">
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-12 mb-4">
                                          <label for="price">Harga</label>
                                          <input wire:model="price" type="number" class="form-control " id="price" placeholder="Masukkan hanya angka, misal : 25000" required>
                                      </div>
                                  </div>
                                  <div class="row mb-4">
                                      <div class="col-md-6">
                                          <select wire:model.live="discountType" class="form-control">
                                              <option value="" selected>-- Pilih Jenis Diskon --</option>
                                              <option value="Diskon Langsung">-- Diskon Langsung --</option>
                                              <option value="Diskon Persen">-- Diskon Persentase Dari Harga Produk --</option>
                                          </select>
                                      </div>
                                      <div class="col-md-6">
                                          <input wire:model="discount" type="number" class="form-control @error('discount') is-invalid @enderror" 
                                          placeholder="{{$discountType == 'Diskon Langsung' ? 'Masukkan hanya angka, misal : 5000' 
                                          : ($discountType == 'Diskon Persen' ? 'Masukkan hanya angka, misal : 10' : 'Abaikan jika tidak ada diskon')}}">
                                          @error('discount') <span class="text-danger">{{$message}}</span> @enderror
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <select wire:model.live="taxType" class="form-control" >
                                              <option value="" selected>-- Pilih Jenis Pajak --</option>
                                              <option value="Pajak Langsung">-- Pajak Langsung --</option>
                                              <option value="Pajak Persen">-- Pajak Persentase Dari Harga Produk --</option>
                                          </select>
                                      </div>
                                      <div class="col-md-6">
                                          <input wire:model="tax" type="number" class="form-control @error('tax') is-invalid @enderror" 
                                          placeholder="{{$taxType == 'Pajak Langsung' ? 'Masukkan hanya angka, misal : 1000' 
                                          : ($taxType == 'Pajak Persen' ? 'Masukkan hanya angka, misal : 12' : 'Abaikan jika tidak ada pajak')}}">
                                          @error('tax') <span class="text-danger">{{$message}}</span> @enderror
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="card">
                          <div class="card-header">
                              <h5><i class="fas fa-layer-group mr-2"></i>Informasi Stok</h5>
                          </div>
                          <div class="card-body">
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <select wire:model.live="stockType" class="form-control" required>
                                              <option value="" selected>-- Pilih Jenis Stok --</option>
                                              <option value="Tak Terbatas">Selalu ada</option>
                                              <option value="Tetap">Tetap</option>
                                          </select>
                                      </div>

                                      @if($stockType && $stockType == 'Tetap')
                                      <div class="col-md-6">
                                          <input wire:model="stock" type="number" class="form-control @error('tax') is-invalid @enderror" 
                                          placeholder="Masukkan hanya angka, misal : 100">
                                          @error('stock') <span class="text-danger">{{$message}}</span> @enderror
                                      </div>
                                      @endif
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="card">
                          <div class="card-body">
                              <div class="form-group">
                                  <label for="productImage">Foto Produk <span class="text-danger">* (Rasio 1:1)</span></label>
                              </div>
                              <div class="form-group">
                                  <div class="row text-center">
                                      <div class="col-md-4 text-center">
                                          <input wire:model.live="productImages.0" type="file" id="image1" class="d-none" accept=".png, .jpg, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                          <label for="image1" class="d-flex justify-content-center align-items-center" 
                                          style="cursor: pointer; width: 150px; height: 150px; border-radius: .25rem;">
                                              <div wire:loading wire:target="productImages.0">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                              </div>

                                              <div wire:loading.remove wire:target="productImages.0">
                                                @if($productImages && isset($productImages[0]))
                                                  <img width="150" height="150" src="{{$productImages[0]->temporaryUrl()}}" alt="Upload Gambar 1">
                                                @else
                                                  <img width="150" height="150" src="{{ asset('assets/image/add-image.png') }}" alt="Upload Gambar 1">
                                                @endif
                                              </div>
                                          </label>
                                      </div>
                                      <div class="col-md-4 text-center">
                                          <input wire:model.live="productImages.1" type="file" id="image2" class="d-none" accept=".png, .jpg, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                          <label for="image2" class="d-flex justify-content-center align-items-center" 
                                          style="cursor: pointer; width: 150px; height: 150px; border-radius: .25rem;">
                                              <div wire:loading wire:target="productImages.1">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                              </div>

                                              <div wire:loading.remove wire:target="productImages.1">
                                                @if($productImages && isset($productImages[1]))
                                                  <img width="150" height="150" src="{{$productImages[1]->temporaryUrl()}}" alt="Upload Gambar 2">
                                                @else
                                                  <img width="150" height="150" src="{{ asset('assets/image/add-image.png') }}" alt="Upload Gambar 2">
                                                @endif
                                              </div>
                                          </label>
                                      </div>
                                      <div class="col-md-4 text-center">
                                          <input wire:model.live="productImages.2" type="file" id="image3" class="d-none" accept=".png, .jpg, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                          <label for="image3" class="d-flex justify-content-center align-items-center" 
                                          style="cursor: pointer; width: 150px; height: 150px; border-radius: .25rem;">
                                              <div wire:loading wire:target="productImages.2">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                              </div>

                                              <div wire:loading.remove wire:target="productImages.2">
                                                @if($productImages && isset($productImages[2]))
                                                  <img width="150" height="150" src="{{$productImages[2]->temporaryUrl()}}" alt="Upload Gambar 3">
                                                @else
                                                  <img width="150" height="150" src="{{ asset('assets/image/add-image.png') }}" alt="Upload Gambar 3">
                                                @endif
                                              </div>
                                          </label>
                                      </div>
                                  </div>
                                  @error('productImages')
                                    <div class="row">
                                      <div class="col-md-12 text-center">
                                        <span class="text-danger">{{$message}}</span>
                                      </div>
                                    </div>
                                  @enderror
                              </div>
                          </div>
                      </div>
                      
                      <div class="card">
                          <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                  <p class="mb-0">Tampilkan produk ini di aplikasi e-commerce</p>
                                  <div class="custom-control custom-switch">
                                      <input wire:model.live="isProductActive" type="checkbox" class="custom-control-input" id="switcher-control-1">
                                      <label class="custom-control-label" for="switcher-control-1"></label>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="card">
                          <div class="card-header">
                              <h5><i class="fas fa-clock mr-2"></i>Waktu Tersedia Produk</h5>
                          </div>
                          <div class="card-body">
                              <div class="form-group">
                                  <div class="row mb-2">
                                      <div class="col-md-6">
                                          <label>Mulai</label>
                                          <input wire:model="availableTimeStart" type="time" class="form-control" required>
                                      </div>
                                      <div class="col-md-6">
                                          <label>Sampai</label>
                                          <input wire:model="availableTimeEnd" type="time" class="form-control" required>
                                      </div>
                                  </div>
                                  <p class="mt-3 mb-0"><b>Catatan :</b></p>
                                  <p class="text-muted medium mb-0">AM = Dimulai dari pukul 12:00 hingga 23:59</p>
                                  <p class="text-muted medium mb-0">PM = Dimulai dari pukul 00:00 hingga 11:59</p>
                              </div>
                          </div>
                      </div>

                      <div class="card">
                          <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                  <p class="mb-0">Rekomendasikan produk di aplikasi e-commerce</p>
                                  <div class="custom-control custom-switch">
                                      <input wire:model.live="isRecommend" type="checkbox" class="custom-control-input" id="switcher-control-2">
                                      <label class="custom-control-label" for="switcher-control-2"></label>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                  </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="float-right">
                    <button wire:click="refresh" type="button" class="btn btn-secondary mr-2">
                      <i class="fas fa-times mr-2"></i>Atur Ulang
                    </button>
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-save mr-2"></i>Simpan
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

        $wire.on('toastCreateProduct', (evt)=> {
            toastr.error(evt.message);
        });

    </script>
    @endscript
  </div>
  <!-- /.content-wrapper -->
</div>
