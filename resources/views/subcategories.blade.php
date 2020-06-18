@extends('layouts.app')

@section('content')
@php
use Illuminate\Support\Facades\Auth;
@endphp
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Registrar') }}</div>

                <div class="card-body">
                    @if(isset($subcategory_edition))
                    <?php $id = $subcategory_edition->id; ?>
                    <form method="POST" action="../update/{{$id}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $subcategory_edition->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>

                            <div class="col-md-6">
                                <select id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category"  required autocomplete="categoria" autofocus>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $subcategory_edition->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option> 
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Editar') }}
                                </button>
                                <a href="{{route('subcategories')}}" class="btn btn-primary">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    @else
                    <form method="POST" action="{{ route('subcategory.new') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>

                            <div class="col-md-6">
                                <select id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" required autocomplete="categoria" autofocus>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>

                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Sub categorias') }}</div>

                <div class="card-body">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            @foreach ($subcategories as $subcategory)
                            @if(Auth::user()->isAdmin())
                            <li class="list-group-item">{{$subcategory->category()}} \ {{$subcategory->name}} : {{$subcategory->item_count}}
                                <div class="right" role="group" aria-label="First group">
                                    <form method="POST" action="/subcategory/edit/{{$subcategory->id}}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            Editar
                                        </button>
                                    </form>
                                    <form method="POST" action="/subcategory/delete/{{$subcategory->id}}">
                                        @csrf
                                        <button type="submit" class="btn btn-dark">X</button>
                                    </form>
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection