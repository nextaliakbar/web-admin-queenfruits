@extends('layouts.app')

@section('title', 'Detail Review')

@section('content')
    @livewire('admin.product.product-review-detail-livewire', ['productId' => request()->route()->parameter('productId')])
@endsection