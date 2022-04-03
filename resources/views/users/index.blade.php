@extends('layouts.app')
@push('title')
    <title>Usuários</title>
@endpush
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Usuários do Sistema</li>
            </ol>
        </nav>
        <div class="table-responsive-sm">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">
                        <a class="btn btn-primary btn-sm" href="{{route('register')}}">+ Adicionar Usuario</a>
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @if($loop->index % 2 == 0)
                        <tr style="background-color: #e9ecef;">
                    @else
                        <tr>
                    @endif
                        <th scope="row">@if($user->photo != '') <img src="{{$user->photo}}" width="50px" alt="Foto" title="Foto do Whatsapp"> @endif</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->department}}</td>
                        <td>{{$user->phone}} @if($user->whatsapp == 1) <i class="fa fa-whatsapp fa-3 text-success"></i> @endif</td>
                        <td>
                            <a href="{{route('usuarios.show', $user->id)}}" class="btn btn-primary btn-sm">Editar</a>
                            @if($loop->index != 0)
                                <a href="{{route('user.delete', $user->id)}}" class="btn btn-secondary btn-sm">Excluir</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
