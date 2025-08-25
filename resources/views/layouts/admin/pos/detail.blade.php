@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
    @livewire('admin.pos.order-detail-pos-livewire', ['orderId' => request()->route()->parameter('orderId')])
@endsection