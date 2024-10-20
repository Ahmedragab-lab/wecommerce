{{-- @if (auth()->user()->hasPermission('update_users')) --}}
    <a href="{{ route('admin.admins.edit', $id) }}" class="btn btn-warning btn-sm" title="@lang('site.edit')"><i class="fa fa-edit"></i> </a>
{{-- @endif --}}

{{-- @if (auth()->user()->hasPermission('delete_users')) --}}
    <button type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target="#delete{{ $id }}" title="@lang('site.delete')">
        <i class="fa fa-trash"></i>
    </button>
{{-- @endif --}}
{{-- modal delete --}}
    <div class="modal fade" id="delete{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">delete user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.admins.destroy', $id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        are you sure to delete admin ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">نعم</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- end modal delete --}}
{{-- modal bulk delete --}}
    <div class="modal fade" id="bulkdelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">delete all user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.admins.bulk_delete','ids') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        are you sure to delete user all ?
                    </div>
                    <input type="hidden" id="delete_all" name="delete_select_id" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Admin/site.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Admin/site.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--End modal bulk delete --}}
