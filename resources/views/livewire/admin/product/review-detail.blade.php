<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3>Salad Buah 100gr</h3>
                        </div>
                        <div>
                            <a wire:navigate href="{{route('admin.product.review')}}">
                                <button type="button" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                        <div class="row align-items-center">
                                            <img width="150" height="150" src="{{asset('assets/image/img2.jpg')}}" alt="Gambar Produk" class="mr-2">
                                            <div class="d-block">
                                                <h4 class="display-2 breadcrumb mb-0" style="background-color: white !important; padding: 0;">
                                                    <span class="breadcrumb-item text-info"><b>5.0</b></span>
                                                    <span class="breadcrumb-item text-secondary"><b>5</b></span>
                                                </h4>
                                                <h5 class="text-secondary">Dari 5 review</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="progress-group">
                                            Sangat Baik
                                            <span class="float-right"><b>160</b>/200</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" style="width: 80%"></div>
                                            </div>
                                        </div>
    
                                        <div class="progress-group">
                                            Baik
                                            <span class="float-right"><b>310</b>/400</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" style="width: 75%"></div>
                                            </div>
                                        </div>

                                        <div class="progress-group">
                                            Cukup
                                            <span class="float-right"><b>480</b>/800</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" style="width: 60%"></div>
                                            </div>
                                        </div>
    
                                        <div class="progress-group">
                                            Kurang
                                            <span class="float-right"><b>250</b>/500</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" style="width: 50%"></div>
                                            </div>
                                        </div>

                                        <div class="progress-group">
                                            Buruk
                                            <span class="float-right"><b>250</b>/500</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" style="width: 50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Review <span class="badge badge-secondary">{{$count ?? 0}}</span></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr style="background-color: #f8f9fa;">
                                                <th>#</th>
                                                <th>Reviewer</th>
                                                <th>Review</th>
                                                <th>Gambar</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
