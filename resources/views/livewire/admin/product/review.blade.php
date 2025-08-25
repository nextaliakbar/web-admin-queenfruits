<div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Review Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-gem mr-1"></i>Pengaturan Produk</li>
              <li class="breadcrumb-item">Review Produk</li>
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
                    <h4>Daftar Review <span class="badge badge-secondary">{{$count ?? 0}}</span></h4>
                  </div>
                  <div class="col-md-4 card-tools">
                    <div class="input-group input-group-md">
                      <input wire:model.live="search" type="text" class="form-control float-right" placeholder="Cari berdasarkan nama produk">
  
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
                      <tr style="background-color: #f8f9fa;">
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Informasi Pelanggan</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th><i class="fas fa-cog"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- @forelse ($productReviews as $productReview)
                      <tr wire:key="{{$productReview->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-3">
                              @if(isset($productReview->product->images[0]))
                                <img width="50" height="50" src="{{asset('uploads/' . $productReview->product->images[0])}}" alt="image">
                              @elseif(isset($productReview->product->images[1]))
                                <img width="50" height="50" src="{{asset('uploads/' . $productReview->product->images[1])}}" alt="image">
                              @elseif(isset($productReview->product->images[2]))
                                <img width="50" height="50" src="{{asset('uploads/' . $productReview->product->images[2])}}" alt="image">
                              @endif
                            </div>
                            <div class="col-md-9">
                              {{$productReview->product->name}}
                            </div>
                          </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    Email
                                    </div>
                                    <div class="col-md-9">
                                    : {{$deliveryMan->email}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Telp
                                    </div>
                                    <div class="col-md-9">
                                    <a href="https://wa.me/628123456789">: +628123456789</a>
                                </div>
                            </div>
                        </td>
                        <td>Bagus</td>
                        <td>5.0</td>
                      </tr>
                      @empty
                        <tr>
                          <td colspan="6" class="text-center text-secondary">
                            <h5>Tidak ada data yang tersedia</h5>
                          </td>
                        </tr>
                      @endforelse --}}
                      <tr>
                        <td>1</td>
                        <td>
                          <div class="row">
                            <div class="col-md-2">
                                <img width="50" height="50" src="{{asset('assets/image/img2.jpg')}}" alt="image">
                            </div>
                            <div class="col-md-10">
                              Salad Buah 100gr
                            </div>
                          </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    Email
                                    </div>
                                    <div class="col-md-9">
                                    : pelanggan1@example.com
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Telp
                                    </div>
                                    <div class="col-md-9">
                                    <a href="https://wa.me/628123456789">: +628123456789</a>
                                </div>
                            </div>
                        </td>
                        <td>Bagus</td>
                        <td>5.0</td>
                        <td>
                          <a wire:navigate href="{{route('admin.product.review-detail', ['productId' => 1])}}">
                            <button type="button" class="btn btn-sm btn-info mr-1 mb-2 mb-md-0">
                              <i class="fas fa-eye"></i>
                            </button>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  {{-- {{$productReviews->links()}} --}}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
</div>
