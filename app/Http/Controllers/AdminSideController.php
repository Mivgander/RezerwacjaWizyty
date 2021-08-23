<?php

namespace App\Http\Controllers;

use App\Models\Terminy;
use Illuminate\Http\Request;

class AdminSideController extends Controller
{
    function terminyWszystkie()
    {
        return Terminy::all();
    }

    function terminyZarezerwowane()
    {
        return Terminy::where('status', 'zarezerwowany')->get();
    }

    function terminyID(Terminy $termin)
    {
        return $termin;
    }

    function terminyDodaj(Request $request)
    {
        $request->validate([
            'data' => 'required|date_format:Y-m-d',
            'godzina' => 'required|date_format:H:i',
            'id_lekarza' => 'required|numeric|exists:lekarze,id'
        ]);

        return Terminy::create([
            'data' => $request->data,
            'godzina' => $request->godzina,
            'lekarze_id' => $request->id_lekarza
        ]);
    }

    function terminyAktualizuj(Terminy $termin, Request $request)
    {
        $request->validate([
            'data' => 'date_format:Y-m-d',
            'godzina' => 'date_format:H:i',
            'status' => 'string|in:wolny,zarezerwowany,ukończony',
            'id_lekarza' => 'numeric|exists:lekarze,id'
        ]);

        if($request->data) $termin->data = $request->data;
        if($request->godzina) $termin->godzina = $request->godzina;
        if($request->status) $termin->status = $request->status;
        if($request->id_lekarza) $termin->lekarze_id = $request->id_lekarza;
        $wynik = $termin->save();

        return [
            'wynik' => $wynik
        ];
    }

    function terminyUsun(Terminy $termin)
    {
        $wynik = $termin->delete();

        return [
            'wynik' => $wynik
        ];
    }
}
