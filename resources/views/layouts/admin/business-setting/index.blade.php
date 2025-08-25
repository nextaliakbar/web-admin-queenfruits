@extends('layouts.app')

@section('title', 'Pengaturan Bisnis')

@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1></i>Pengaturan Bisnis</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><i class="fas fa-cog mr-1"></i>Pengaturan Bisnis</li>
                <li class="breadcrumb-item">
                    {{request()->routeIs('admin.business-setting.business-info') ? 'Informasi Bisnis' : 
                    (request()->routeIs('admin.business-setting.store-time-schedule') ? 'Jadwal Waktu Toko' : 
                    (request()->routeIs('admin.business-setting.store-delivery-fees') ? 'Biaya Pengiriman Toko' : 
                    (request()->routeIs('admin.business-setting.store-order-setting') ? 'Pengaturan Pesanan Toko' : '')))}}
                </li>
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
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a wire:navigate href="{{route('admin.business-setting.business-info')}}" 
                                class="nav-link {{request()->routeIs('admin.business-setting.business-info') ? 'active' : ''}}">
                                    <h5>Informasi Bisnis</h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a wire:navigate href="{{route('admin.business-setting.store-time-schedule')}}" 
                                class="nav-link {{request()->routeIs('admin.business-setting.store-time-schedule') ? 'active' : ''}}">
                                    <h5>Jadwal Waktu Toko</h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a wire:navigate href="{{route('admin.business-setting.store-delivery-fees', ['branchId' => 1])}}" 
                                class="nav-link {{request()->routeIs('admin.business-setting.store-delivery-fees') ? 'active' : ''}}">
                                    <h5>Biaya Pengiriman Toko</h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a wire:navigate href="{{route('admin.business-setting.store-order-setting')}}" 
                                class="nav-link {{request()->routeIs('admin.business-setting.store-order-setting') ? 'active' : ''}}">
                                    <h5>Pengaturan Pesanan Toko</h5>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    @yield('businessSettingContent')
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    </div>
@endsection