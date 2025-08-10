@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    @livewire('admin.product.edit-product-livewire', ['productId' => request()->route()->parameter('productId')])
@endsection