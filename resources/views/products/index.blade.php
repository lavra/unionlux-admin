@extends('layouts.app')
@push('title')
    <title>Produtos</title>
@endpush
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.css"/>
@endpush
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produtos</li>
            </ol>
        </nav>
        <table id="products" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Foto</th>
                <th>Código</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Status</th>
                <th><a class="btn btn-primary btn-sm" href="{{route('produtos.create')}}">+ Adicionar Produto</a></th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Foto</th>
                <th>Código</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            </tfoot>
        </table>

    </div>
@endsection
@push('scripts')
    <script>
        const table = $('#products');
        $(document).ready(function() {
            table.DataTable( {
                language: {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    }
                },

                processin: true,
                serverSide: true,
                ajax: {
                    url: "{{route('products.data')}}",
                    type: "POST",
                    dataType: "json",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                },

                sPaginationType: "full_numbers",
                iDisplayLength: 30,
                columns:[
                    {data: 'image', className:'align-center', orderable:false, searchable:false},
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'category_id', orderable:false, searchable:false},
                    {data: 'description'},
                    {data: 'active', className:'align-center'},
                    {data: 'actions', className:'actions', orderable:false, searchable:false}
                ],
                order: [[1, 'desc']]
            });

        });
    </script>
    <script type="text/javascript" src="{{asset('vendor/datatable/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.js"></script>
@endpush