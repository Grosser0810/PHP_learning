@extends('admin-panel')

@section('title')
    Список продуктов
@endsection

@section('content')
    @foreach($products as $product)
        {{ $product->name }}
    @endforeach
@endsection