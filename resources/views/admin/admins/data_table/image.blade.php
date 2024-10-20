
@if($user->image)
    <img src="{{display_file($user->image)}}" style="width: 50px; height: 50px;"
    alt="{{ $user->name }}" >
@else
    <img src="{{ asset('no-image.jpg') }}" style="width: 50px;" alt="{{ $user->name }} ">
@endif



