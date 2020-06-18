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
                    @if(isset($category_edition))
                    <?php $id = $category_edition->id; ?>
                    <form method="POST" action="../update/{{$id}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category_edition->name }}" required autocomplete="name" autofocus>

                                @error('name')
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
                                <a href="{{route('register')}}" class="btn btn-primary">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    @else
                    <form method="POST" action="{{ route('category.new') }}">
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
                <div class="card-header">{{ __('Categorias') }}</div>

                <div class="card-body">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            @foreach ($categories as $category)
                            @if(Auth::user()->isAdmin())
                            <li class="list-group-item">{{$category->name}}
                                <div class="right" role="group" aria-label="First group">
                                    <form method="POST" action="/category/edit/{{$category->id}}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            Editar
                                        </button>
                                    </form>
                                    <form method="POST" action="/category/delete/{{$category->id}}">
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