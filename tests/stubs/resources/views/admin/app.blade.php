<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? "$title — " : '' }} Laravel beyond CRUD</title>

    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
</head>
<body>
    @if($flashMessage = flash()->getMessage())
        <div class="{{ $flashMessage->level }} p-2 font-bold">
            {{ $flashMessage->message }}
        </div>
    @endif

    @isset($title)
        <h1 class="px-2 mt-4 text-3xl">{{ $title }}</h1>
    @endisset

    {{ $slot }}
</body>
</html>
