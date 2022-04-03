@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Alterar {{$product->name}} - Foto: 370x450 (pixels)</div>
                    @include('includes.alerts')
                    <div class="card-body">
                        <form method="POST" action="{{ url("produtos/$product->slug") }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('products.form')
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Alterar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
