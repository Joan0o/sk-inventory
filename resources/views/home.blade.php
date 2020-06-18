@extends('layouts.app')

@section('content')
@php
$items = App\Item::orderBy('name', 'asc')->where('status', 'active')->get();;
$categories = App\Category::orderBy('name', 'asc')->where('status', 'active')->where('id', '<>', '7')->get();;
    $subC = App\Subcategory::orderBy('name', 'asc')->where('status', 'active')->where('id', '<>', '2')->get();;
        @endphp
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">Dashboard</div>
                        <div class="card-body">
                            <h1>Categorías</h1>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach ($categories as $category)
                                <label class="btn btn-secondary active">
                                    <input type="checkbox" name="{{$category->name}}" id="{{$category->id}}" checked> {{$category->name}}
                                </label>
                                @endforeach
                            </div>
                            <hr>
                            <h2>Sub categorías</h2>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach ($subC as $s)
                                <label class="btn btn-secondary active">
                                    <input type="checkbox" name="{{$s->name}}" id="{{$s->id}}" checked> {{$s->category()}} \ {{$s->name}} : {{$s->item_count}}
                                </label>
                                @endforeach
                            </div>
                            <hr>
                            <h3>Productos</h3>
                            <div style="display:flex;flex-wrap: wrap;" data-toggle="buttons">
                                @foreach ($items as $key => $item)
                                @if($key % 3 == 0)
                                <hr class="break">
                                @endif
                                <li class="list-group-item">{{$item->name}}</li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection