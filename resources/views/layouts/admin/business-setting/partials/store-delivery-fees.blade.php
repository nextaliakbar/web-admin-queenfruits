@extends('layouts.admin.business-setting.index')

@section('title', 'Biaya Pengiriman Toko')

@section('businessSettingContent')
    <div class="card-header">
        <ul class="nav nav-pills">
            @foreach (App\Models\Branch::all() as $branch)
                <li wire:key="{{$branch->id}}" class="nav-item">
                    <a wire:navigate href="{{route('admin.business-setting.store-delivery-fees', ['branchId' => $branch->id])}}" 
                    class="nav-link {{request()->route()->parameter('branchId') == $branch->id ? 'active' : ''}}">
                        <h5>{{$branch->name}}</h5>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    @livewire('admin.business-setting.store-delivery-fees-livewire', ['branchId' => request()->route()->parameter('branchId')])
@endsection

