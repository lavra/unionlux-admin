@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <p><strong>Alterar:</strong> {{$data->name}}, os campos com <span class="text-danger">*</span> são obrigatórios.</p>
                        <p><strong>Senha:</strong> Se deixar o campo senha em branco, não altera a senha.</p>
                        <p><strong>Whatsapp:</strong> Se selecionar, adiciona o usuário na lista do Whtasapp para contato.</p>
                        <p><strong>Inativo:</strong> O usuário não tem acesso ao sistema administrativo</p>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('usuarios.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }} <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$data->name}}" required autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }} <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$data->email}}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Departamento') }} <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{$data->department}}" required autofocus>
                                    @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirme a Senha') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('DDD Telefone') }} <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$data->phone}}" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="expander form-check-input" type="checkbox" name="whatsapp" value="1" id="whatsapp1" @if($data->whatsapp == 1) checked @endif>
                                        <label class="form-check-label" for="whatsapp1">
                                            Whatsapp
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="whatsapp-fields" @if($data->whatsapp == 1) style="display: block" @else style="display: none" @endif>
                                <div class="form-group row">
                                    <label for="message_whatsapp" class="col-md-4 col-form-label text-md-right">{{ __('Mensagem do Whatsapp') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control @error('message_whatsapp') is-invalid @enderror" name="message_whatsapp"" name="message_whatsapp" id="message_whatsapp" rows="3">{{$data->message_whatsapp}}</textarea>
                                        @error('message_whatsapp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="active" class="col-md-4 col-form-label text-md-right"><span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="active" id="active1" value="1" @if($data->active == 1) checked @endif>
                                        <label class="form-check-label" for="active1"> Ativo</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="active" id="active0" value="0" @if($data->active == 0) checked @endif>
                                        <label class="form-check-label" for="active0"> Inativo</label>
                                    </div>
                                </div>
                            </div>
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
@push('scripts')
    <script>
        $(function () {
            $('.expander').on('click', function () {
                $('#whatsapp-fields').toggle();
            });
        });
    </script>
@endpush
