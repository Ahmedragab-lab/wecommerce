<span class="font-weight-bold badge badge-pill badge-{{ $user->status == 1 ? 'success' : 'danger'  }}">
    {{ $user->status == 1 ? __('site.active') : __('site.unactive') }}<br>
</span>
<br><i class='fa fa-exchange'></i>
{{__('site.change')}}
<a href="{{route('admin.change_status',encrypt($user->id))}}" title="للتحويل الى  {{ ($user->status == 1) ? trans('site.unactive') : trans('site.active') }} ">
    {{ $user->status == 1 ? __('site.unactive') : __('site.active') }}
</a>
