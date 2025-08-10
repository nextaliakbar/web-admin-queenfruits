<div>
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa"></i>Tambah Kategori Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-sitemap mr-1"></i>Kategori Produk</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <!-- form start -->
              <form wire:submit.prevent='{{$isEditMode ? "update" : "store"}}'>
                  <div class="card-body">
                      <div class="form-group mb-2">
                          <label for="name">Nama <span class="text-danger">*</span></label>
                          <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                          id="name" placeholder="Misal: Buah Olahan" required>
                      </div>
                      @error('name')
                      <div class="form-group">
                          <span class="text-danger">{{$message}}</span>
                      </div>
                      @enderror

                      <div class="row">
                        <div class="col-md-6 mb-4 d-flex justify-content-center align-items-center" style="align-content: center;">
                            <div wire:loading wire:target="categoryFile">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div wire:loading.remove wire:target="categoryFile">
                                @if ($categoryFile)
                                    <img class="img-fluid rounded border" src="{{ $categoryFile->temporaryUrl() }}" alt="image"/>
                                @elseif ($existingCategoryFile)
                                    <img class="img-fluid rounded border" src='{{ asset("uploads/$existingCategoryFile") }}' alt="image"/>
                                @else
                                    <img class="img-fluid rounded border" src="{{ asset('assets/image/img2.jpg') }}" alt="image"/>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 d-flex justify-content-center align-items-center">
                            <div wire:loading wire:target="bannerFile">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            <div wire:loading.remove wire:target="bannerFile">
                                @if ($bannerFile)
                                    <img class="img-fluid rounded border" src="{{ $bannerFile->temporaryUrl() }}" alt="image"/>
                                @elseif ($existingBannerFile)
                                    <img class="img-fluid rounded border" src='{{ asset("uploads/$existingBannerFile") }}' alt="image"/>
                                @else
                                    <img class="img-fluid rounded border" src="{{ asset('assets/image/img1.jpg') }}" alt="image"/>
                                @endif
                            </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="categoryFile">Gambar Kategori <span class="text-danger"> (Rasio 1:1)</span></label>
                                  <div class="input-group">
                                      <div class="custom-file">
                                          <input wire:model.live="categoryFile" type="file" class="custom-file-input @error('categoryFile') is-invalid @enderror" 
                                          accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                          <label class="custom-file-label" for="categoryFile">
                                            @if($categoryFile)
                                              {{$categoryFile->getClientOriginalName()}}
                                            @elseif($existingCategoryFile)
                                              {{basename($existingCategoryFile)}}
                                            @else
                                              Pilih File
                                            @endif
                                          </label>
                                      </div>
                                  </div>
                                  @error('categoryFile')
                                  <div class="mt-2">
                                      <span class="text-danger">{{$message}}</span>
                                  </div>
                                  @enderror
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="bannerFile">Gambar Banner Kategori <span class="text-danger"> (Rasio 2:1)</span></label>
                                  <div class="input-group">
                                      <div class="custom-file">
                                          <input wire:model.live="bannerFile" type="file" class="custom-file-input @error('bannerFile') is-invalid @enderror" 
                                          accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                          <label class="custom-file-label" for="bannerFile">
                                            @if($bannerFile)
                                              {{$bannerFile->getClientOriginalName()}}
                                            @elseif($existingBannerFile)
                                              {{basename($existingBannerFile)}}
                                            @else
                                              Pilih File
                                            @endif
                                          </label>
                                      </div>
                                  </div>
                                  @error('categoryFile')
                                  <div class="mt-2">
                                      <span class="text-danger">{{$message}}</span>
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
            <!-- /.card -->
        </div>
        <!-- /.row -->
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!-- card-header -->
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <div>
                    <h3 class="card-title">Daftar Kategori Produk</h3>
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
                        <th>Gambar Kategori</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Prioritas</th>
                        <th><i class="fas fa-cog"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($categories as $category)
                      <tr wire:key="{{$category->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td>
                          <img width="50" height="50" src="{{$category->image ? asset("uploads/$category->image") : asset('assets/image/img2.jpg')}}" alt="image">
                        </td>
                        <td>{{$category->name}}</td>
                        <td>
                          <div class="custom-control custom-switch">
                            <input wire:click="updateStatus({{$category->id}})" type="checkbox" class="custom-control-input" 
                            id="customSwitch-{{$category->id}}" {{$category->status == 1 ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customSwitch-{{$category->id}}"></label>
                          </div>
                        </td>
                        <td>
                          <select wire:change="updatePriority({{$category->id}}, $event.target.value)" class="form-control">
                            @for ($i = 1; $i <= 10; $i++)
                              <option value="{{$i}}" {{$category->priority == $i ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                          </select>
                        </td>
                        <td>
                          <button wire:click="edit({{$category->id}})" type="button" class="btn btn-sm btn-warning mr-1 mb-2 mb-md-0">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button wire:click="confirm({{$category->id}})" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
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
                  {{$categories->links()}}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </section>
    <!-- /.content -->

    @script
    <script>
      'use-strict';

      $wire.on('toastCreateCategory', (evt)=> {
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
          toastr.error(evt.error);
        }
      });

      $wire.on('toastUpdatePriority', (evt)=> {
        if(evt.success) {
          toastr.success(evt.message);
        } else {
          toastr.success(evt.message);
        }
      });

      $wire.on('toastUpdateCategory', (evt)=> {
        if(evt.success) {
          toastr.success(evt.message);
        } else {
          toastr.error(evt.message);
        }
      });

      $wire.on('toastDestroyCategory', (evt)=> {
        if(evt.success) {
          $('#deleteModal').modal("hide");
          toastr.success(evt.message);
        } else {
          $('#deleteModal').modal("hide");
          toastr.error(evt.message);
        }
      });
    </script>
    @endscript
    <!-- /.content-wrapper -->

    <!-- delete modal -->
    @include('livewire.admin.category.delete')
    <!-- ./delete modal -->
  </div>
</div>
