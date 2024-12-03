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

<a href="{{ config('static.url_portal_ts3_main').'info' }}">Link ke Info</a>
<a href="{{ config('static.url_portal_ts3_main').'clean' }}">Clean session</a>
<a href="{{ config('static.url_portal_ts3_main').'back' }}">Back lobby</a>
</body>
</html>
