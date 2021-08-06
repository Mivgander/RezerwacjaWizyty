<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Terminy</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .id-width
        {
            width: 5%;
        }

        .col-width
        {
            width: 15.83%;
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
                        <th class="id-width py-2 border-r-2 border-black">ID</th>
                        <th class="col-width py-2 border-r-2 border-black">Lekarz</th>
                        <th class="col-width py-2 border-r-2 border-black">Data</th>
                        <th class="col-width py-2 border-r-2 border-black">Godzina</th>
                        <th class="col-width py-2 border-r-2 border-black">Status</th>
                        <th class="col-width py-2 border-r-2 border-black">Kto rezerwuje</th>
                        <th class="col-width py-2">Powód wizyty</th>
                    </tr>
                    @foreach($terminy as $termin)
                        <tr class="w-full flex justify-between text-center text-lg">
                            <td class="id-width py-2 border-r-2 border-black">{{$termin->id}}</td>
                            <td class="col-width py-2 border-r-2 border-black break-words">{{ucfirst($termin->lekarze->imie) . ' ' . ucfirst($termin->lekarze->nazwisko)}}</td>
                            <td class="col-width py-2 border-r-2 border-black break-words">{{$termin->data}}</td>
                            <td class="col-width py-2 border-r-2 border-black break-words">{{$termin->godzina}}</td>
                            <td class="col-width py-2 border-r-2 border-black break-words">{{$termin->status}}</td>
                            @if($termin->rezerwacje)
                                <td class="col-width py-2 border-r-2 border-black break-words">{{$termin->rezerwacje->email}}</td>
                            @else
                                <td class="col-width py-2 border-r-2 border-black">-</td>
                            @endif
                            @if($termin->rezerwacje)
                                <td class="col-width py-2 break-words">{{$termin->rezerwacje->powod_rezerwacji}}</td>
                            @else
                                <td class="col-width py-2">-</td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="mb-16">
                <h1 class="text-3xl my-10">Dodaj wolny termin</h1>
                <form action="{{ url('api/admin/terminy/dodaj') }}" method="post">
                    <div class="block">
                        <div class="mb-2">
                            <label class="text-lg">Podaj id lekarza:</label>
                            <input type="number" min="1" name="id_lekarza" required class="border-2 border-black outline-none text-lg">
                        </div>
                        <div class="mb-2">
                            <label class="text-lg">Podaj datę:</label>
                            <input type="date" name="data" required class="border-2 border-black outline-none text-lg">
                        </div>
                        <div class="mb-2">
                            <label class="text-lg">Podaj godzinę:</label>
                            <input type="time" name="godzina" required class="border-2 border-black outline-none text-lg">
                        </div>
                        <div class="mb-2">
                            <input type="submit" value="dodaj" class="px-2 border-2 border-black outline-none text-lg">
                        </div>
                    </div>
                </form>
            </div>

            <div class="mb-16">
                <h1 class="text-3xl my-10">Aktualizuj termin</h1>
                <form action="{{ url('api/admin/terminy/aktualizuj') }}" method="post">
                    @method('PATCH')
                    <div class="block">
                        <div class="mb-2">
                            <label class="text-lg">Podaj id terminu:</label>
                            <input type="number" min="1" name="id_terminu" required class="border-2 border-black outline-none text-lg">
                        </div>
                        <div class="mb-2">
                            <label class="text-lg">Podaj datę:</label>
                            <input type="date" name="data" class="border-2 border-black outline-none text-lg">
                        </div>
                        <div class="mb-2">
                            <label class="text-lg">Podaj godzinę:</label>
                            <input type="time" name="godzina" class="border-2 border-black outline-none text-lg">
                        </div>
                        <div class="mb-2">
                            <label class="text-lg">Podaj id lekarza:</label>
                            <input type="number" min="1" name="id_lekarza" class="border-2 border-black outline-none text-lg">
                        </div>
                        <div class="mb-2">
                            <label class="text-lg">Podaj status:</label>
                            <select name="status" class="border-2 border-black outline-none text-lg">
                                <option value="" selected hidden disabled></option>
                                <option value="wolny">wolny</option>
                                <option value="zarezerwowany">zarezerwowany</option>
                                <option value="ukończony">ukończony</option>
                            </select>
                            <span class="text-lg text-red-600">Jeśli wybierzesz status wolny to usuniesz rezerwacje!</span>
                        </div>
                        <div class="mb-2">
                            <input type="submit" value="zmień" class="px-2 border-2 border-black outline-none text-lg">
                        </div>
                    </div>
                </form>
            </div>

            <div class="mb-16">
                <h1 class="text-3xl my-10">Usuń termin</h1>
                <form action="{{ url('api/admin/terminy/usun') }}" method="post">
                    @method('delete')
                    <div class="block">
                        <div class="mb-2">
                            <label class="text-lg">Podaj id terminu:</label>
                            <input type="number" min="1" name="id_terminu" required class="border-2 border-black outline-none text-lg">
                        </div>
                        <div class="mb-2">
                            <input type="submit" value="usuń" class="px-2 border-2 border-black outline-none text-lg">
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </main>
</body>
</html>
