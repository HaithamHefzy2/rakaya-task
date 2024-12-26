@extends('layouts.master')
@section('content')
    <div class="dashboard-content-one">
        <div class="breadcrumbs-area">
            <h3>{{ trans('dashboard.Users') }}</h3>
            <ul>
                <li>
                    <a href="/">{{ trans('dashboard.home') }}</a>
                </li>
                <li>{{ trans('dashboard.All_Users') }}</li>
            </ul>
        </div>
        <div class="card height-auto">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display" id="users-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('dashboard.Name') }}</th>
                            <th>{{ trans('dashboard.Email') }}</th>
                            <th>{{ trans('dashboard.Roles') }}</th>
                            <th>{{ trans('dashboard.Action') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
@endsection

@section('script')
    <script>
                    $(document).ready(function () {
                        let t = $('#users-table').DataTable({
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
                ajax: "{{ route('users.ajax') }}",
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'roles', orderable: false, searchable: false },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endsection
