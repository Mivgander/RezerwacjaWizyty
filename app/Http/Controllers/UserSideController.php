<?php

namespace App\Http\Controllers;

use App\Models\Rezerwacje;
use App\Models\Terminy;
use Illuminate\Http\Request;

class UserSideController extends Controller
{
    function terminyWszystkie()
    {
        $terminy = [];

        foreach(Terminy::all() as $row)
        {
            $terminy[] = [
                'lekarz' => ucfirst($row->lekarze->imie) . ' ' . ucfirst($row->lekarze->nazwisko),
                'data' => $row->data,
                'godzina' => $row->godzina,
                'status' => $row->status
            ];
        }

        return $terminy;
    }

    function terminyWolne()
    {
        $terminy = [];

        foreach(Terminy::where('status', 'wolny')->get() as $row)
        {
            $terminy[] = [
                'lekarz' => ucfirst($row->lekarze->imie) . ' ' . ucfirst($row->lekarze->nazwisko),
                'data' => $row->data,
                'godzina' => $row->godzina,
                'status' => $row->status
            ];
        }

        return $terminy;
    }

    function terminyRezerwuj(Terminy $termin, Request $request)
    {
        if($termin->status == 'zarezerwowany') return abort(404);

        $request->validate([
            'email' => 'required|email',
            'powod_rezerwacji' => 'required|max:255'
        ]);

        $rezerwacja = Rezerwacje::create([
            'email' => $request->email,
            'powod_rezerwacji' => $request->powod_rezerwacji,
            'terminy_id' => $termin->id
        ]);

        return $rezerwacja;
    }

    function terminyOdwolaj(Terminy $termin)
    {
        if($termin->status != 'zarezerwowany') return abort(404);

        $wynik = 'elo';

        foreach(Rezerwacje::where('terminy_id', $termin->id)->get() as $rezerwacja)
        {
            $wynik = $rezerwacja->delete();
        }

        return [
            'wynik' => $wynik
        ];
    }
}
