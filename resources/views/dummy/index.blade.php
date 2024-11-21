<!DOCTYPE html>
<html>
<head>
    <title>Data Sesi</title>
</head>
<body>

<div>
    <h1>Data Module</h1>
    <ul>
        @foreach ($module as $key => $value)
            <li>{{ $key }}: {{ $value }}</li>
        @endforeach
    </ul>
</div>

<div>
    <h1>Data User</h1>
    <ul>
        @foreach ($user as $key => $value)
            <li>{{ $key }}: {{ $value }}</li>
        @endforeach
    </ul>
</div>

<a href="{{ config('static.url_puninar_app').'info' }}">Link ke Info</a>
<a href="{{ config('static.url_puninar_app').'clean' }}">Clean session</a>
<a href="{{ config('static.url_puninar_app').'back' }}">Back lobby</a>
</body>
</html>
