<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
<div style="text-align: center">
    <img src="<?=asset('img/logo/mvlogo.png')?>" style="width: 100px">
    @if($user_type == 1)
        <h2>{{$info->first_name}} {{$info->last_name}} shared his/her profile on MyVoluntier.com</h2>
        <h3>{{$content}}</h3>
        <p>Click below link to visit <strong>Profile Page</strong></p>
        <br/>
        <a href="{{url('/profile')}}/{{$info->id}}">Visit Profile</a>
    @else
        <h2>{{$info->org_name}} shared it's profile on MyVoluntier.com</h2>
        <h3>{{$content}}</h3>
        <p>Click below link to visit <strong>Profile Page</strong></p>
        <br/>
        <a href="{{url('/profile')}}/{{$info->id}}">Visit Profile</a>
    @endif
    <p>Thanks</p>
    <p>myvoluntier.com</p>
</div>
</body>
</html>
