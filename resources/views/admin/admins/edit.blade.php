@extends('admin.layouts.master')

@section('content')

    <div>
        <h2>@lang('admins.admins')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">@lang('admins.admins')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.admins.update', $admin->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    {{-- @include('admin.partials._errors') --}}

                    <div class="row">
                        <div class="col-md-6">
                           {{--name--}}
                            <div class="form-group">
                                <label>@lang('users.name')<span class="text-danger">*</span></label>
                                {{-- <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus> --}}
                                <input type="text" name="name" class="form-control" value="{{ old('name',$admin->name) }}"  >
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--email--}}
                            <div class="form-group">
                                <label>@lang('users.email')<span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email',$admin->email) }}"  >
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                              {{--phone--}}
                            <div class="form-group">
                                <label>@lang('users.phone')<span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone',$admin->phone) }}" placeholder="phone"
                                    maxlength="11" minlength="11"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                                @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--status--}}
                            <div class="form-group">
                                <label>@lang('users.status')<span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status',$admin->status) == 1 ? 'selected' : null }}>{{ __('site.active') }}</option>
                                    <option value="0" {{ old('status',$admin->status) == 0 ? 'selected' : null }}>{{ __('site.unactive') }}</option>
                                </select>
                                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--password--}}
                            <div class="form-group">
                                <label>@lang('users.password')<span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" value="{{ old('password') }}"  placeholder="password" >
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--password_confirmation--}}
                            <div class="form-group">
                                <label>@lang('users.password_confirmation')<span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" >
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('admins.image') </label>
                                <input class="form-control img" name="image"  type="file" accept="image/*" >
                                <span class="form-text text-muted">Image width should be 500px x 500px</span>
                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if($admin->image)
                              <img src="{{display_file($admin->image)}}" alt="{{ $admin->name }}" class="img-thumbnail img-preview" width="200px">
                            @else
                              <img src="{{ asset('no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="100px">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1">@lang('admins.permissions')</label>
                                <div class="inp-holder mb-1">
                                    <label for="name">{{ __('admins.selectall') }}</label>
                                    <input type="checkbox"  id="selectall" >
                                </div>
                                <div class="table-holder">
                                    {{-- <label for="">@lang('roles.permissions')<span class="text-danger">*</span> </label> --}}
                                    <div class="table-responsive">
                                        <table class="table main-table">
                                            <thead>
                                                <tr>
                                                    <th>@lang('roles.model')</th>
                                                    <th>{{ __('admins.selectall') }}</th>
                                                    @foreach($permissionMaps as $key => $value)
                                                      <th>@lang('site.' . $value)
                                                        <div style="display:inline-block;">
                                                              <label class="m-0">
                                                                  <input type="checkbox" value=""  onclick="SelectAll(this)"  class="side-roles" id="side-roles">
                                                              </label>
                                                          </div>
                                                      </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($models as $model)
                                                    <tr>
                                                        <td>@lang($model . '.' . $model)</td>
                                                        <td>
                                                            <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                                <label class="m-0">
                                                                    <input type="checkbox" value=""  class="all-roles">
                                                                    <span class="label-text">{{ __('admins.all') }}</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        @foreach ($permissionMaps as $permissionMap)
                                                            <td>
                                                                <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                                    <label class="m-0">
                                                                        <input type="checkbox" value="{{ $permissionMap . '_' . $model }}" name="permissions[]"
                                                                        {{ $admin->hasPermission($permissionMap . '_' . $model) ? 'checked' : '' }} class="role">
                                                                        <span class="label-text">@lang('site.' . $permissionMap) @lang($model . '.' . $model)</span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @error('permissions')
                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                    @enderror
                                    <!-- end of table -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('#selectall').click(function(event) {  //on click
            // console.log('hello');
            if(this.checked) { // check select status
                $('.role').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "role"
                });
            }else{
                $('.role').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "role"
                });
            }
            var chkArray = [];
            $("input[name='check[]']:checked").map(function() {
                chkArray.push(this.value);
            }).get();
            var selected;
            selected = chkArray.join(',') + ",";
            // if(selected.length > 1){
            //     alert('هل تريد تحديد الكل?');
            // } else { alert(' تحديد الكل'); }
        });
    });
</script>
<script>
        $(function () {
        $(document).on('change', '.all-roles', function () {
            $(this).parents('tr').find('input[type="checkbox"]').prop('checked', this.checked);
        });
        $(document).on('change', '.role', function () {
            if (!this.checked) {
                $(this).parents('tr').find('.all-roles').prop('checked', this.checked);
            }
            // else{
            //     $(this).parents('tr').find('.all-roles').prop('checked', this.checked);
            // }
        });

    });//end of document ready

</script>
<script>
   function SelectAll(obj) {
       var table = $(obj).closest('table');
       var th_s = table.find('th');
       var current_th = $(obj).closest('th');
       var columnIndex = th_s.index(current_th) + 1;
       table.find('td:nth-child(' + (columnIndex) + ') input').prop("checked", obj.checked);
   }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#pass_log_id");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@endpush
