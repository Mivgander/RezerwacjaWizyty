<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminy</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .col-width
        {
            width: 20%;
        }
    </style>
</head>
<body class="bg-gray-50">
    <main class="py-10 max-w-7xl mx-auto">
        @if($error != 'brak')
            <h1 class="text-3xl text-center text-red-700 font-bold">{{ucfirst($error)}}</h1>
        @else
            <h1 class="text-3xl text-center font-bold mb-5">WSZYSTKIE TERMINY</h1>
            <div class="bg-gray-200">
                <table class="w-full">
                    <tr class="w-full flex justify-between text-center text-xl border-b-2 border-black">
                        <th class="col-width py-2 border-r-2 border-black">Lekarz</th>
                        <th class="col-width py-2 border-r-2 border-black">Data</th>
                        <th class="col-width py-2 border-r-2 border-black">Godzina</th>
                        <th class="col-width py-2 border-r-2 border-black">Status</th>
                        <th class="col-width py-2">Akcja</th>
                    </tr>
                    @foreach($terminy as $termin)
                        <tr class="w-full flex justify-between text-center text-lg">
                            <td class="col-width py-2 border-r-2 border-black break-words">{{ucfirst($termin->lekarze->imie) . ' ' . ucfirst($termin->lekarze->nazwisko)}}</td>
                            <td class="col-width py-2 border-r-2 border-black break-words">{{$termin->data}}</td>
                            <td class="col-width py-2 border-r-2 border-black break-words">{{$termin->godzina}}</td>
                            <td class="col-width py-2 border-r-2 border-black break-words">{{$termin->status}}</td>
                            @if($termin->rezerwacje)
                                <td class="col-width py-2 break-words"><button onclick="showOdwolaj({{$termin->id}})" class="hover:underline text-purple-700">Odwołaj rezerwację</button></td>
                            @else
                                <td class="col-width py-2 break-words"><button onclick="showRezerwuj({{$termin->id}})" class="hover:underline text-purple-700">Zarezerwuj</button></td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>

            <div id="rezerwacja_form" class="fixed top-0 left-0 w-full h-full hidden" style="background-color: rgba(10, 10, 10, 0.4); justify-content: center; align-items: center;">
                <div class="bg-white w-96 px-4 py-2 relative">
                    <div class="absolute top-3 right-3">
                        <button onclick="hideRezerwuj()" class="text-xl font-bold">X</button>
                    </div>
                    <h1 class="text-3xl mb-10">Zarezerwuj termin</h1>
                    <form action="{{ url('api/terminy/rezerwuj') }}" method="post">
                        <div class="block">
                            <input id="rezerwacja_id_terminu" type="number" name="id_terminu" hidden>
                            <div class="mb-2">
                                <label class="text-lg">Podaj swój email:</label>
                                <input type="email" name="email" required class="border-2 border-black outline-none text-lg">
                            </div>
                            <div class="mb-2">
                                <label class="text-lg">Podaj powód rezerwacji:</label><br>
                                <textarea name="powod_rezerwacji" required cols="40" rows="4" class="border-2 border-black outline-none text-lg"></textarea>
                            </div>
                            <div class="mb-2">
                                <input type="submit" value="rezerwuj" class="px-2 border-2 border-black outline-none text-lg">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="odwolaj_form" class="fixed top-0 left-0 w-full h-full hidden" style="background-color: rgba(10, 10, 10, 0.4); justify-content: center; align-items: center;">
                <div class="bg-white w-96 px-4 py-2 relative">
                    <div class="absolute top-3 right-3">
                        <button onclick="hideOdwolaj()" class="text-xl font-bold">X</button>
                    </div>
                    <h1 class="text-3xl mb-10">Odwołaj rezerwację</h1>
                    <form action="{{ url('api/terminy/odwolaj-rezerwacje') }}" method="post">
                        @method('delete')
                        <div class="block">
                            <div class="mb-2">
                                <input id="odwolaj_id_terminu" type="number" name="id_terminu" hidden>
                                <label class="text-lg leading-3">Podaj email, na który zosatała złożona rezerwacja:</label><br>
                                <input type="email" name="email" required class="border-2 border-black outline-none text-lg">
                            </div>
                            <div class="mb-2">
                                <input type="submit" value="odwolaj" class="px-2 border-2 border-black outline-none text-lg">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </main>
    <script>
        const inputIdTerminuRezerwacja = document.getElementById('rezerwacja_id_terminu');
        const formRezerwuj = document.getElementById('rezerwacja_form');

        const inputIdTerminuOdwolaj = document.getElementById('odwolaj_id_terminu');
        const formOdwolaj = document.getElementById('odwolaj_form');

        function showRezerwuj(id)
        {
            formRezerwuj.style.display = "flex";
            inputIdTerminuRezerwacja.value = id;
        }

        function showOdwolaj(id)
        {
            formOdwolaj.style.display = "flex";
            inputIdTerminuOdwolaj.value = id;
        }

        function hideRezerwuj()
        {
            formRezerwuj.style.display = "none";
        }

        function hideOdwolaj()
        {
            formOdwolaj.style.display = "none";
        }
    </script>
</body>
</html>
