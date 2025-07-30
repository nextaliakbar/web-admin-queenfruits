@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    @livewire('admin.product.edit-product', ['productId' => $productId])
@endsection