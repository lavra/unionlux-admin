@extends('layouts.app')
@push('title')
    <title>Categorias</title>
@endpush

@push('styles')
<style>
.modal-confirm {
    color: #636363;
    width: 400px;
}
.modal-confirm .modal-content {
    padding: 20px;
    border-radius: 5px;
    border: none;
    text-align: center;
    font-size: 14px;
}
.modal-confirm .modal-header {
    border-bottom: none;
    position: relative;
}
.modal-confirm h4 {
    text-align: center;
    font-size: 26px;
    margin: 30px 0 -10px;
}
.modal-confirm .close {
    position: absolute;
    top: -5px;
    right: -2px;
}
.modal-confirm .modal-body {
    color: #999;
}
.modal-confirm .modal-footer {
    border: none;
    text-align: center;
    border-radius: 5px;
    font-size: 13px;
    padding: 10px 15px 25px;
}
.modal-confirm .modal-footer a {
    color: #999;
}
.modal-confirm .icon-box {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    border-radius: 50%;
    z-index: 9;
    text-align: center;
    border: 3px solid #f15e5e;
}
.modal-confirm .icon-box i {
    color: #f15e5e;
    font-size: 46px;
    display: inline-block;
    margin-top: 13px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
    color: #fff;
    border-radius: 4px;
    background: #60c7c1;
    text-decoration: none;
    transition: all 0.4s;
    line-height: normal;
    min-width: 120px;
    border: none;
    min-height: 40px;
    border-radius: 3px;
    margin: 0 5px;
}
.modal-confirm .btn-secondary {
    background: #c1c1c1;
}
.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
    background: #a8a8a8;
}
.modal-confirm .btn-danger {
    background: #f15e5e;
}
.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
    background: #ee3535;
}
.trigger-btn {
    display: inline-block;
    margin: 100px auto;
}
</style>
@endpush
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categorias dos Produtos</li>
            </ol>
        </nav>
        <div class="table-responsive-sm">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Ordem</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Status</th>
                    <th scope="col">
                        <a class="btn btn-primary btn-sm" href="{{route('categorias.create')}}">+ Adicionar Categoria</a>
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                        <tr>
                            <th scope="row"><img src="{{$pathFile}}/{{$category->image}}" width="50px" alt="Foto" title="Foto da Categoria"></th>
                            <td>{{$category->order}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td>
                                @if($category->active == 1)
                                    <i class="fa fa-check text-success"></i> Ativo
                                @else
                                    <i class="fa fa-check text-danger"></i> Inativo
                                @endif
                            </td>
                            <td>
                                <a href="#modalConfirm" data-toggle="modal" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>
                                <form id="remove-category-{{$category->slug}}" action="{{route('categorias.destroy', $category->slug)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                                <a href="{{route('categorias.show', $category->slug)}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i> </a>
                                @php
                                    $slug = $category->slug;
                                @endphp
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('includes.modal-confirm', [
        'id' => $slug ?? '',
        'mainTitle' => "Existe produtos vinculados a esta categoria.",
        'mainContent' => "Para excluir todos os produtos e esta categoria clique no botão excluir."
        ])
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endpush
