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
                    @if(isset($item_edition))
                    <?php $id = $item_edition->id; ?>
                    <form method="POST" action="../update/{{$id}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item_edition->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>

                            <div class="col-md-7">
                                <div style="display:flex;flex-wrap: wrap;" class="btn-group btn-group-toggle" data-toggle="buttons">
                                    @foreach ($subcategories as $s)
                                    <?php $continue = true; ?>
                                    @foreach ($sub_item as $relation)
                                    @if($relation->sub === $s->id)
                                    <label class="btn btn-secondary btn-sm active">
                                        <input type="checkbox" name="categories[]" value="{{$s->id}}" checked> {{$s->category()}} \ {{$s->name}} : {{$s->item_count}}
                                    </label>        
                                    <?php $continue = false; ?>
                                    @endif
                                    @endforeach
                                    @if($continue)
                                    <label class="btn btn-secondary btn-sm">
                                        <input type="checkbox" name="categories[]" value="{{$s->id}}"> {{$s->category()}} \ {{$s->name}} : {{$s->item_count}}
                                    </label>
                                    @endif
                                    @endforeach
                                </div>
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
                                <a href="{{route('items')}}" class="btn btn-primary">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    @else
                    <form method="POST" action="{{ route('item.new') }}">
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

                            <div class="col-md-7">
                                <div id="" style="display:flex;flex-wrap: wrap;" class="btn-group btn-group-toggle" data-toggle="buttons">
                                    @foreach ($subcategories as $key => $s)
                                    @if($key % 3 == 0)
                                    <div class="break"></div>
                                    @endif
                                    <label class="btn btn-secondary btn-sm">
                                        <input type="checkbox" name="categories[]" value="{{$s->id}}"> {{$s->category()}} \ {{$s->name}} : {{$s->item_count}}
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="new_item" onClick="new_item" type="submit" class="btn btn-primary">
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
                <div class="card-header">{{ __('Productos') }}</div>

                <div class="card-body">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            @foreach ($items as $item)
                            @if(Auth::user()->isAdmin())
                            <li class="list-group-item">{{$item->name}}
                                <div class="right" role="group" aria-label="First group">
                                    <form method="POST" action="/item/edit/{{$item->id}}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            Editar
                                        </button>
                                    </form>
                                    <form method="POST" action="/item/delete/{{$item->id}}">
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