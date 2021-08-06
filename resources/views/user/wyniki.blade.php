<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynik</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <main class="py-10 max-w-7xl mx-auto">
        @if($error != 'brak')
            <h1 class="text-3xl text-center text-red-700 font-bold">{{ucfirst($error)}}</h1>
        @else
            <h1 class="text-3xl text-center text-green-700 font-bold">{{ucfirst($wiadomosc)}}</h1>
        @endif
    </main>
</body>
</html>
