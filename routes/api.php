<?php

use App\Http\Controllers\AdminSideController;
use App\Models\Lekarze;
use App\Models\Rezerwacje;
use App\Models\Terminy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//STRONA ADMINISTRATORA

/* POKAZANIE WSZYSTKICH TERMINÓW */
Route::get('admin/terminy/wszystkie', [AdminSideController::class, 'terminyWszystkie']);
/* POKAZANIE WSZYSTKICH TERMINÓW */

/* POKAZANIE ZAREZERWOWANYCH TERMINÓW */
Route::get('admin/terminy/zarezerwowane', [AdminSideController::class, 'terminyZarezerwowane']);
/* POKAZANIE ZAREZERWOWANYCH TERMINÓW */

/* POKAZANIE TERMINU SZUKANEGO PO ID */
Route::get('admin/terminy/{termin}', [AdminSideController::class, 'terminyID']);
/* POKAZANIE TERMINU SZUKANEGO PO ID */

/* DODAWANIE TERMINU */
Route::post('admin/terminy/dodaj', [AdminSideController::class, 'terminyDodaj']);
/* DODAWANIE TERMINU */

/* AKTUALIZACJA TERMINU */
Route::put('admin/terminy/aktualizuj/{termin}', [AdminSideController::class, 'terminyAktualizuj']);
/* AKTUALIZACJA TERMINU */

/* USUWANIE TERMINU */
Route::delete('raw/admin/terminy/usun', function(Request $request){
    if(!$request->id_terminu) return response()->json([
        'error' => 'nie znaleziono id terminu'
    ], 400);

    if(!Terminy::where('id', $request->id_terminu)->exists())
    {
        return response()->json([
            'error' => 'nie znaleziono terminu o podanym id'
        ], 404);
    }
    else
    {
        $termin = Terminy::find($request->id_terminu);
        $termin->delete();
    }

    return ['wiadomosc' => 'Pomyślnie usunięto termin'];
});

Route::delete('admin/terminy/usun', function(Request $request){
    if(!$request->id_terminu) return view('admin.wyniki', [
        'error' => 'nie znaleziono id terminu'
    ]);

    if(!Terminy::where('id', $request->id_terminu)->exists())
    {
        return view('admin.wyniki', [
            'error' => 'nie znaleziono terminu o podanym id'
        ]);
    }
    else
    {
        $termin = Terminy::find($request->id_terminu);
        $termin->delete();
    }

    return view('admin.wyniki', [
        'error' => 'brak',
        'wiadomosc' => 'Pomyślnie usunięto termin'
    ]);
});
/* USUWANIE TERMINU */


//STRONA KLIENTA

/* POKAZANIE WSZYSTKICH TERMINÓW */
Route::get('raw/terminy', function(){
    if(Terminy::where('id', '>=', '1')->exists())
        return Terminy::all();
    else
        return response()->json([
            'error' => 'nie znaleziono wolnych terminów'
        ], 404);
});

Route::get('terminy', function(){
    if(Terminy::where('id', '>=', '1')->exists())
        return view('user.terminy', [
            'error' => 'brak',
            'terminy' => Terminy::all()
        ]);
    else
        return view('user.terminy', [
            'error' => 'nie znaleziono wolnych terminów',
        ]);
});
/* POKAZANIE WSZYSTKICH TERMINÓW */

/* POKAZANIE WOLNYCH TERMINÓW */
Route::get('raw/terminy/wolne', function(){
    if(Terminy::where('status', 'wolny')->exists())
        return Terminy::where('status', 'wolny')->get();
    else
        return response()->json([
            'error' => 'nie znaleziono wolnych terminów'
        ], 404);
});

Route::get('terminy/wolne', function(){
    if(Terminy::where('status', 'wolny')->exists())
        return view('user.terminy', [
            'error' => 'brak',
            'terminy' => Terminy::where('status', 'wolny')->get()
        ]);
    else
        return view('user.terminy', [
            'error' => 'nie znaleziono wolnych terminów',
        ]);
});
/* POKAZANIE WOLNYCH TERMINÓW */

/* REZERWACJA WOLNEGO TERMINU */
Route::post('raw/terminy/rezerwuj', function(Request $request){
    /* WALIDACJA EMAILA */
    if(!$request->email) return response()->json([
        'error' => 'nie wpisano emaila'
    ], 400);

    if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) return response()->json([
        'error' => 'podany email jest niewłaściwie napisany'
    ], 400);
    /* WALIDACJA EMAILA */

    /* WALIDACJA POWODU REZERWACJI */
    if(!$request->powod_rezerwacji) return response()->json([
        'error' => 'nie wpisano powodu rezerwacji'
    ], 400);

    if(strlen($request->powod_rezerwacji) == 0) return response()->json([
        'error' => 'powód rezerwacji nie może być pusty'
    ], 400);
    else if(strlen($request->powod_rezerwacji) > 255) return response()->json([
        'error' => 'powód rezerwacji nie może być dłuższy niż 255 znaków'
    ], 400);

    $request->powod_rezerwacji = trim($request->powod_rezerwacji);
    $request->powod_rezerwacji = stripslashes($request->powod_rezerwacji);
    $request->powod_rezerwacji = htmlspecialchars($request->powod_rezerwacji);
    /* WALIDACJA POWODU REZERWACJI */

    /* WALIDACJA ID TERMINU */
    if(!$request->id_terminu) return response()->json([
        'error' => 'nie znaleziono id terminu'
    ], 400);

    if(!Terminy::where('id', $request->id_terminu)->exists())
    {
        return response()->json([
            'error' => 'nie znaleziono terminu o podanym id'
        ], 404);
    }

    if(Rezerwacje::where('terminy_id', $request->id_terminu)->exists()) return response()->json([
        'error' => 'podany termin jest już zarezerwowany'
    ]);
    /* WALIDACJA ID TERMINU */

    $rezerwacja = Rezerwacje::create([
        'email' => $request->email,
        'powod_rezerwacji' => $request->powod_rezerwacji,
        'terminy_id' => $request->id_terminu
    ]);

    $rezerwacja->terminy->status = 'zarezerwowany';
    $rezerwacja->terminy->save();

    return ['wiadomosc' => 'Zarezerwowano pomyślnie'];
});

Route::post('terminy/rezerwuj', function(Request $request){
    /* WALIDACJA EMAILA */
    if(!$request->email) return view('user.wyniki', [
        'error' => 'nie wpisano emaila'
    ]);

    if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) return view('user.wyniki', [
        'error' => 'podany email jest niewłaściwie napisany'
    ]);
    /* WALIDACJA EMAILA */

    /* WALIDACJA POWODU REZERWACJI */
    if(!$request->powod_rezerwacji) return view('user.wyniki', [
        'error' => 'nie wpisano powodu rezerwacji'
    ]);

    if(strlen($request->powod_rezerwacji) == 0) return view('user.wyniki', [
        'error' => 'powód rezerwacji nie może być pusty'
    ]);
    else if(strlen($request->powod_rezerwacji) > 255) return view('user.wyniki', [
        'error' => 'powód rezerwacji nie może być dłuższy niż 255 znaków'
    ]);

    $request->powod_rezerwacji = trim($request->powod_rezerwacji);
    $request->powod_rezerwacji = stripslashes($request->powod_rezerwacji);
    $request->powod_rezerwacji = htmlspecialchars($request->powod_rezerwacji);
    /* WALIDACJA POWODU REZERWACJI */

    /* WALIDACJA ID TERMINU */
    if(!$request->id_terminu) return view('user.wyniki', [
        'error' => 'nie znaleziono id terminu'
    ]);

    if(!Terminy::where('id', $request->id_terminu)->exists())
    {
        return view('user.wyniki', [
            'error' => 'nie znaleziono terminu o podanym id'
        ]);
    }

    if(Rezerwacje::where('terminy_id', $request->id_terminu)->exists()) return view('user.wyniki', [
        'error' => 'podany termin jest już zarezerwowany'
    ]);
    /* WALIDACJA ID TERMINU */

    $rezerwacja = Rezerwacje::create([
        'email' => $request->email,
        'powod_rezerwacji' => $request->powod_rezerwacji,
        'terminy_id' => $request->id_terminu
    ]);

    return view('user.wyniki', [
        'error' => 'brak',
        'wiadomosc' => 'Zarezerwowano pomyślnie'
    ]);
});
/* REZERWACJA WOLNEGO TERMINU */

/* ODWOŁANIE REZERWACJI */
Route::delete('raw/terminy/odwolaj-rezerwacje', function(Request $request){
    if(!$request->email) return response()->json([
        'error' => 'nie wpisano emaila'
    ], 400);

    if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) return response()->json([
        'error' => 'podany email jest niewłaściwie napisany'
    ], 400);

    if(!$request->id_terminu) return response()->json([
        'error' => 'nie znaleziono id terminu'
    ]);

    if(!Rezerwacje::where('terminy_id', $request->id_terminu)->exists())
    {
        return response()->json([
            'error' => 'nie znaleziono zarezerwowanego terminu o podanym id'
        ], 404);
    }
    else
    {
        $rezerwacja = Rezerwacje::where('terminy_id', $request->id_terminu)->firstOrFail();

        if($rezerwacja->email != $request->email) return response() ->json([
            'error' => 'podadny adres email nie jest prawidłowy'
        ], 400);

        $rezerwacja->terminy->status = 'wolny';
        $rezerwacja->terminy->save();
        $rezerwacja->delete();
    }

    return ['wiadomosc' => 'rezerwację odwołano pomyślnie'];
});

Route::delete('terminy/odwolaj-rezerwacje', function(Request $request){
    /* WALIDACJA EMAILA */
    if(!$request->email) return view('user.wyniki', [
        'error' => 'nie wpisano emaila'
    ]);

    if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) return view('user.wyniki', [
        'error' => 'podany email jest niewłaściwie napisany'
    ]);
    /* WALIDACJA EMAILA */

    /* WALDACJA ID TERMINU */
    if(!$request->id_terminu) return view('user.wyniki', [
        'error' => 'nie znaleziono id terminu'
    ]);
    /* WALDACJA ID TERMINU */

    if(!Rezerwacje::where('terminy_id', $request->id_terminu)->exists())
    {
        return view('user.wyniki', [
            'error' => 'nie znaleziono zarezerwowanego terminu o podanym id'
        ]);
    }
    else
    {
        $rezerwacja = Rezerwacje::where('terminy_id', $request->id_terminu)->firstOrFail();

        if($rezerwacja->email != $request->email) return view('user.wyniki', [
            'error' => 'podadny adres email nie jest prawidłowy'
        ]);

        $rezerwacja->terminy->status = 'wolny';
        $rezerwacja->terminy->save();
        $rezerwacja->delete();
    }

    return view('user.wyniki', [
        'error' => 'brak',
        'wiadomosc' => 'rezerwację odwołano pomyślnie'
    ]);
});
/* ODWOŁANIE REZERWACJI */
