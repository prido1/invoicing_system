<html>
<head></head>
<body>
<div style="display: grid; align-items: center;">
    <img style="width: 100px" src="{{asset('logo.png')}}">
    <h1>{{$global_settings['app_name']}}</h1>
</div>
{!! $title !!}
{!! $content !!}
</body>
</html>