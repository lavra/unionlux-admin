@extends('layouts.app')
@push('title')
    <title>Newsletters</title>
@endpush

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.css"/>
@endpush
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Newsletters</li>
            </ol>
        </nav>
        <div id="return-newsletter"></div>
        <table id="newsletters" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Data</th>
                <th>Email</th>
                <th>Receber Notícias</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Data</th>
                <th>Email</th>
                <th>Receber Notícias</th>
            </tr>
            </tfoot>
        </table>

    </div>
@endsection
@push('scripts')
    <script>
        const table = $('#newsletters');
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
                    url: "{{route('newsletters.data')}}",
                    type: "POST",
                    dataType: "json",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                },

                sPaginationType: "full_numbers",
                iDisplayLength: 30,
                columns:[
                    {data: 'updated_at', className:'align-center'},
                    {data: 'email'},
                    {data: 'active', className:'align-center'}
                ],
                order: [[0, 'desc']]
            });

        });
    </script>
    <script type="text/javascript" src="{{asset('vendor/datatable/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.js"></script>
    <script>
        function activeNewsletter(url, id) {

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data:{
                    '_token': $('input[name="_token"]').val(),
                    '_method': 'PUT'
                },
                beforeSend: function() {
                    $('#btn-active-'+id).prop("disabled", true);
                },
                success:function(data){
                    if (data.success == true) {
                        $('#btn-active-'+id).data("active", data.active);
                        changeClassBtn(id)
                    }
                    $('#btn-active-'+id).prop("disabled", false);
                    let msg = displayAlert('success', data.message)
                    $('#return-newsletter').html(msg);
                    $('#return-newsletter').fadeOut(3000);
                },
                error: function(xhr) {
                    $('#btn-active-'+id).prop("disabled", false);
                    let msg = displayAlert('danger', 'Houve um erro no servidor, tente mais tarde.')
                    $('#return-newsletter').html(msg);
                    $('#return-newsletter').fadeOut(3000);
                }
            });
        }
        /**
         * Configuração dos alerts.
         * @param cls
         * @param message
         * @returns {string}
         */
        function displayAlert(cls, message) {
            return  '<div class="alert alert-'+cls+' mt-1" role="alert">' + message + '</div>';
        }

        function changeClassBtn(id) {
            let active = $('#btn-active-'+id).data("active");
            if (active == 1) {
                $('#btn-active-'+id).removeClass("btn-danger");
                $('#btn-active-'+id).addClass("btn-info");
            } else {
                $('#btn-active-'+id).removeClass("btn-info");
                $('#btn-active-'+id).addClass("btn-danger");
            }
        }


    </script>
@endpush