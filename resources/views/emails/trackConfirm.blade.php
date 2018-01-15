<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
<div style="text-align: center">
    <img src="<?=asset('img/logo/mvlogo.png')?>" style="width: 100px">
    <h3>{{$user_info->first_name}} {{$user_info->last_name}} is asking Approve hours he/she added on MyVoluntier.com</h3>
    <h2>Please signup to MyVoluntier.com as Organization account to Confirm added hours.</h2>
    <p>After Sign-up,Please click below link to confirm <strong>Tracked Hours</strong></p>
    <br/>
    <a href="{{url('/')}}/organization/track/customConfirm/{{$track_id}}/{{$confirm_code}}">Confirm Hours</a>
    <p>Thanks</p>
    <p>myvoluntier.com</p>
</div>
</body>
</html>
