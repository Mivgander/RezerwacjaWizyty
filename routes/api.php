<?php

use App\Http\Controllers\AdminSideController;
use App\Http\Controllers\UserSideController;
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
Route::post('admin/terminy', [AdminSideController::class, 'terminyDodaj']);
/* DODAWANIE TERMINU */

/* AKTUALIZACJA TERMINU */
Route::put('admin/terminy/{termin}', [AdminSideController::class, 'terminyAktualizuj']);
/* AKTUALIZACJA TERMINU */

/* USUWANIE TERMINU */
Route::delete('admin/terminy/{termin}', [AdminSideController::class, 'terminyUsun']);
/* USUWANIE TERMINU */


//STRONA KLIENTA

/* POKAZANIE WSZYSTKICH TERMINÓW */
Route::get('terminy/wszystkie', [UserSideController::class, 'terminyWszystkie']);
/* POKAZANIE WSZYSTKICH TERMINÓW */

/* POKAZANIE WOLNYCH TERMINÓW */
Route::get('terminy/wolne', [UserSideController::class, 'terminyWolne']);
/* POKAZANIE WOLNYCH TERMINÓW */

/* REZERWACJA WOLNEGO TERMINU */
Route::post('terminy/{termin}', [UserSideController::class, 'terminyRezerwuj']);
/* REZERWACJA WOLNEGO TERMINU */

/* ODWOŁANIE REZERWACJI */
Route::delete('terminy/{termin}', [UserSideController::class, 'terminyOdwolaj']);
/* ODWOŁANIE REZERWACJI */
