@extends('layouts.app')

@section('title', 'Edit Cabang')

@section('content')
    @livewire('admin.branch.edit-branch-livewire', ['branchId' => request()->route()->parameter('branchId')])
@endsection