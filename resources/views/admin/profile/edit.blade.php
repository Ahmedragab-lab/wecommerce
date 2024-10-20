@extends('admin.layouts.master')
@section('title','edit profile')
@section('content')

    <div>
        <h2>@lang('users.edit_profile')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('users.edit_profile')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-6">
                            {{--name--}}
                            <div class="form-group">
                                <label>@lang('users.name')</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--email--}}
                            <div class="form-group">
                                <label>@lang('users.email')</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--phone--}}
                          <div class="form-group">
                              <label>@lang('users.phone')<span class="text-danger">*</span></label>
                              <input type="tel" name="phone" class="form-control" value="{{ old('phone',auth()->user()->phone) }}" placeholder="phone"
                                  maxlength="11" minlength="11"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                              @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                          </div>
                      </div>
                        <div class="col-md-6">
                            {{--image--}}
                            <div class="form-group">
                                <label>@lang('admins.image') <span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control img" accept="image/*">
                                <img src="{{ auth()->user()->image_path }}" class="loaded-image" alt="" style="display: block; width: 200px; margin: 10px 0;">
                                <div class="col-md-4">
                                    @if(auth()->user()->image)
                                      <img src="{{display_file(auth()->user()->image)}}" alt="{{ auth()->user()->name }}" class="img-thumbnail img-preview" width="200px">
                                    @else
                                      <img src="{{ asset('no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="100px">
                                    @endif
                                </div>
                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    {{--submit--}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
