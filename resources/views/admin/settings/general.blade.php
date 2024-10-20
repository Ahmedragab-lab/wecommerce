@extends('admin.layouts.master')
@section('title','setting')
@section('content')

    <div><h2>@lang('settings.settings')</h2></div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('settings.general_settings')</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <form method="post" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-md-6">
                            {{--logo--}}
                            <div class="form-group">
                                <label>@lang('settings.logo')</label>
                                <input type="file" name="logo" class="form-control load-image">
                                <img src="{{ Storage::url('uploads/' . setting('logo')) }}"
                                     class="loaded-image" alt=""
                                     style="display: {{ setting('logo') ? 'block' : 'none' }}; width: 100px; margin: 10px 0;">
                                     @error('logo')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--fav_icon--}}
                            <div class="form-group">
                                <label>@lang('settings.fav_icon')</label>
                                <input type="file" name="fav_icon" class="form-control load-image">
                                <img src="{{ Storage::url('uploads/' . setting('fav_icon')) }}"
                                class="loaded-image" alt="" style="display: {{ setting('fav_icon') ? 'block' : 'none' }}; width: 50px; margin: 10px 0;">
                                @error('fav_icon')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            {{--website_name--}}
                            <div class="form-group">
                                <label>@lang('settings.website_name')</label>
                                <input type="text" name="website_name" class="form-control" value="{{ setting('website_name') }}">
                                @error('website_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            {{--title--}}
                            <div class="form-group">
                                <label>@lang('settings.title')</label>
                                <input type="text" name="title" class="form-control" value="{{ setting('title') }}">
                                @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            {{--link--}}
                            <div class="form-group">
                                <label>@lang('settings.link')</label>
                                <input type="text" name="link" class="form-control" value="{{ setting('link') }}">
                                @error('link')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            {{--website_active--}}
                            <div class="form-group">
                                <label>@lang('settings.website_active')</label>
                                <select name="website_active" id="website_active" class="form-control">
                                    <option value="1"  {{ old('website_active', setting('website_active')) == 1 ? 'selected' : '' }}>مفعل</option>
                                    <option value="0"  {{ old('website_active', setting('website_active')) == 1 ? 'selected' : '' }}>غير مفعل</option>
                                </select>
                                @error('website_active')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            {{--keywords--}}
                            <div class="form-group">
                                <label>@lang('settings.keywords')</label>
                                <input type="text" name="keywords" class="form-control" value="{{ setting('keywords') }}">
                                @error('keywords')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            {{--email--}}
                            <div class="form-group">
                                <label>@lang('users.email')</label>
                                <input type="text" name="email" class="form-control" value="{{ setting('email') }}">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            {{--description--}}
                           <div class="form-group">
                               <label>@lang('settings.description')</label>
                               <textarea name="description" class="form-control">{{ setting('description') }}</textarea>
                               @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                           </div>
                       </div>
                    </div>
                    {{--submit--}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of title -->
        </div><!-- end of col -->
    </div><!-- end of row -->
@endsection
