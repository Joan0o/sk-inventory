@extends('layouts.app')

@section('content')
@php
$items = App\Item::orderBy('name', 'asc')->where('status', 'active')->get();;
$categories = App\Category::orderBy('name', 'asc')->where('status', 'active')->where('id', '<>', '7')->get();;
$subC = App\Subcategory::orderBy('name', 'asc')->where('status', 'active')->get();;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <h1>Categorías</h1>
                    <ul class="list-group list-group-flush">
                        @foreach ($categories as $category)
                        <li class="list-group-item">{{$category->name}}</li>
                        @endforeach
                    </ul>
                    <hr>
                    <h2>Sub categorías</h2>
                    <ul class="list-group list-group-flush">
                        @foreach ($subC as $s)
                        <li class="list-group-item">{{$s->name}}<br>{{$s->item_count}}</li>
                        @endforeach
                    </ul>
                    <hr>
                    <h3>Productos</h3>
                    <ul class="list-group list-group-flush">
                        @foreach ($items as $item)
                        <li class="list-group-item">{{$item->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection