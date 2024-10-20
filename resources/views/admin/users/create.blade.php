@extends('admin.layouts.master')

@section('content')

    <div>
        <h2>@lang('users.users')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">@lang('users.users')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    {{-- @include('admin.partials._errors') --}}
                    <div class="row">
                        <div class="col-md-6">
                           {{--name--}}
                            <div class="form-group">
                                <label>@lang('users.name')<span class="text-danger">*</span></label>
                                {{-- <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus> --}}
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="name" >
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--email--}}
                            <div class="form-group">
                                <label>@lang('users.email')<span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email" >
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                              {{--phone--}}
                            <div class="form-group">
                                <label>@lang('users.phone')<span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="phone"
                                    maxlength="11" minlength="11"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                                @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--status--}}
                            <div class="form-group">
                                <label>@lang('users.status')<span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : null }}>{{ __('site.active') }}</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : null }}>{{ __('site.unactive') }}</option>
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
                                <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cover </label>
                                <input class="form-control img" name="image"  type="file" accept="image/*" >
                                <span class="form-text text-muted">Image width should be 500px x 500px</span>
                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('images/no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="200px">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


