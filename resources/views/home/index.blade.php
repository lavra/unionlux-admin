@extends('layouts.app')
@push('title')
    <title>Admin {{config('app.name')}}</title>
@endpush

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Conteudos da página principal do site</li>
            </ol>
        </nav>

        @include('home._partials.slider')
@endsection
@push('scripts')
    <script>
        $('.show-form-slider').on('click', function () {
            $('#form-slider').css('display', 'block');
        });
    </script>
@endpush
