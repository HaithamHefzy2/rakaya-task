@extends('layouts.master')
@section('content')
    <div class="dashboard-content-one">

        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>{{trans('dashboard.books')}}</h3>
            <ul>
                <li>
                    <a href="/">{{trans('dashboard.home')}}</a>
                </li>
                <li>{{trans('dashboard.All_Books')}}</li>
            </ul>
        </div>
        <!-- Breadcubs Area End Here -->

        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>{{trans('dashboard.All_Books')}}</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap" id="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('dashboard.Title')}}</th>
                            <th>{{trans('dashboard.Author')}}</th>
                            <th>{{trans('dashboard.Availability')}}</th>
                            <th>{{trans('dashboard.Action')}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- Table Area End Here -->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            let t = $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i>',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF'
                    },
                    {
                        extend: 'colvis',
                        text: 'select items',
                    }
                ],
                processing: true,
                serverSide: true,
                pagingType: "full_numbers",
                order: [[1, 'asc']],
                bDestroy: true,
                iDisplayLength: 25,

                ajax: "{{route('books.ajax')}}",
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title' },
                    { data: 'author' },
                    { data: 'is_available' },
                    { data: 'action', orderable: false, searchable: false }
                ],
            });
        });
    </script>
@endsection
