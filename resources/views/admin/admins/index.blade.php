@extends('admin.layouts.master')
@section('content')
    <div>
        <h2>@lang('admins.admins')</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('admins.admins')</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        {{-- @if (auth()->user()->hasPermission('read_users')) --}}
                            <a href="{{ route('admin.admins.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        {{-- @endif --}}

                        {{-- @if (auth()->user()->hasPermission('delete_users')) --}}
                            <button type="button" class="btn btn-danger" id="btn_delete_all" data-toggle="modal"
                                    data-target="#bulkdelete" ><i class="fa fa-trash"></i>
                                    @lang('site.bulk_delete')
                            </button>
                        {{-- @endif --}}
                    </div>
                </div><!-- end of row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')">
                        </div>
                    </div>
                </div><!-- end of row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table datatable" id="users-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="animated-checkbox">
                                                <label class="m-0">
                                                    <input type="checkbox" name="select_all" id="select-all">
                                                    <span class="label-text"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>#</th>
                                        <th>@lang('admins.image')</th>
                                        <th>@lang('users.name')</th>
                                        <th>@lang('users.email')</th>
                                        <th>@lang('users.phone')</th>
                                        <th>@lang('users.status')</th>
                                        <th>@lang('site.created_at')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!-- end of table responsive -->
                    </div><!-- end of col -->
                </div><!-- end of row -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
@endsection
@push('js')
    <script>
        let usersTable = $('#users-table').DataTable({
            // dom: "tiplr",
            dom: 'Brltip',
            buttons: ['excel','pdf',
            {
                extend: 'print',
                text: 'Print selected',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
            serverSide: true,
            processing: true,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.admins.data') }}',
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[7, 'desc']],
        });

        $('#data-table-search').keyup(function () {
            usersTable.search(this.value).draw();
        })
    </script>
@endpush
