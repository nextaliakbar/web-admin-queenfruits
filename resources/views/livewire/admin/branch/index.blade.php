<div>
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Cabang <span class="badge badge-secondary">{{$count ?? 0}}</span></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-store mr-1"></i>Cabang Bisnis</li>
              <li class="breadcrumb-item">Daftar Cabang</li>
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
                    <a wire:navigate href="{{route('admin.branch.add')}}">
                      <button class="btn btn-md btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                      </button>
                    </a>
                  </div>
                  <div class="col-md-4 card-tools">
                    <div class="input-group input-group-md">
                      <input wire:model.live="search" type="text" class="form-control float-right" placeholder="Cari berdasarkan cabang">
  
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
                        <th>Nama Cabang</th>
                        <th>Jenis Cabang</th>
                        <th>Informasi Kontak</th>
                        <th>Jenis Biaya Pengiriman</th>
                        <th>Promosi Cabang</th>
                        <th>Status</th>
                        <th><i class="fas fa-cog"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($branches as $branch)
                      <tr wire:key="{{$branch->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$branch->name}}</td>
                        <td>{{$branch->id == 1 ? 'Cabang Utama' : 'Sub Cabang'}}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-4">
                              Email
                            </div>
                            <div class="col-md-8">
                              : {{$branch->email}}
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              No. Telp
                            </div>
                            <div class="col-md-8">
                              <a href="https://wa.me/{{substr($branch->telp, 1)}}">: {{$branch->telp}}</a>
                            </div>
                          </div>
                        </td>
                        <td>{{$branch->delivery_charge_setup->delivery_charge_type}}</td>
                        <td>
                          <div class="custom-control custom-switch">
                            <input wire:click="updatePromotionCampaign({{$branch->id}})" type="checkbox" class="custom-control-input" 
                            id="promotionCampaignControll-{{$branch->id}}" {{$branch->promotion_campaign == 1 ? 'checked' : ''}}>
                            <label class="custom-control-label" for="promotionCampaignControll-{{$branch->id}}"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-switch">
                            <input wire:click="updateStatus({{$branch->id}})" type="checkbox" class="custom-control-input" 
                            id="statusControll-{{$branch->id}}" {{$branch->status == 1 ? 'checked' : ''}}>
                            <label class="custom-control-label" for="statusControll-{{$branch->id}}"></label>
                          </div>
                        </td>
                        <td>
                          <a wire:navigate href="{{route('admin.business-setting.store-delivery-fees', ['branchId' => $branch->id])}}">
                            <button type="button" class="btn btn-sm btn-info mr-1 mb-2 mb-md-0">
                              <i class="fas fa-cog"></i>
                            </button>
                          </a>
                          <a wire:navigate href="{{route('admin.branch.edit', ['branchId' => $branch->id])}}">
                            <button type="button" class="btn btn-sm btn-warning mr-1 mb-2 mb-md-0">
                              <i class="fas fa-edit"></i>
                            </button>
                          </a>
                          @if($branch->id != 1)
                          <button wire:click="confirm({{$branch->id}})" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash"></i>
                          </button>
                          @endif
                        </td>
                      </tr>
                      @empty
                        <tr>
                          <td colspan="8" class="text-center text-secondary">
                            <h5>Tidak ada data yang tersedia</h5>
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                  {{$branches->links()}}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
    </section>
    <!-- /.content -->

    @include('livewire.admin.branch.delete')

    @script
      <script>
        $wire.on('toastUpdateStatus', (evt)=> {
          if(evt.success) {
            toastr.success(evt.message);
          } else {
            toastr.error(evt.message);
          }
        });

        $wire.on('toastUpdatePromotionCampaign', (evt)=> {
          if(evt.success) {
            toastr.success(evt.message);
          } else {
            toastr.error(evt.message);
          }
        });

        $wire.on('toastDeleteBranch', (evt)=> {
          $('#deleteModal').modal('hide');
          if(evt.success) {
            toastr.success(evt.message);
          } else {
            toastr.error(evt.message);
          }
        });

        $wire.on('toastCreateBranch', (evt)=> {
          toastr.success(evt.message);
        });

        $wire.on('toastUpdateBranch', (evt)=> {
          toastr.success(evt.message);
        });
      </script>
    @endscript
  </div>
  <!-- /.content-wrapper -->
</div>
