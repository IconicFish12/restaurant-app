<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? env('APP_NAME') }}</title>
</head>
<body>

    @foreach ($user as $item)
    {{ $item->username }}
    {{ $item->email }}
    @endforeach

    <a href="{{ asset('logout') }}">Logout</a>

    {{-- SWEET ALERT --}}
    @include('sweetalert::alert')

</body>
</html>
