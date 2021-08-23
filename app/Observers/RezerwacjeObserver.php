<?php

namespace App\Observers;

use App\Models\Rezerwacje;
use App\Models\Terminy;

class RezerwacjeObserver
{
    /**
     * Handle the Rezerwacje "created" event.
     *
     * @param  \App\Models\Rezerwacje  $rezerwacje
     * @return void
     */
    public function created(Rezerwacje $rezerwacje)
    {
        $termin = Terminy::find($rezerwacje->terminy_id);
        $termin->update([
            'status' => 'zarezerwowany'
        ]);
    }

    /**
     * Handle the Rezerwacje "updated" event.
     *
     * @param  \App\Models\Rezerwacje  $rezerwacje
     * @return void
     */
    public function updated(Rezerwacje $rezerwacje)
    {
        //
    }

    /**
     * Handle the Rezerwacje "deleted" event.
     *
     * @param  \App\Models\Rezerwacje  $rezerwacje
     * @return void
     */
    public function deleted(Rezerwacje $rezerwacje)
    {
        //
    }

    /**
     * Handle the Rezerwacje "restored" event.
     *
     * @param  \App\Models\Rezerwacje  $rezerwacje
     * @return void
     */
    public function restored(Rezerwacje $rezerwacje)
    {
        //
    }

    /**
     * Handle the Rezerwacje "force deleted" event.
     *
     * @param  \App\Models\Rezerwacje  $rezerwacje
     * @return void
     */
    public function forceDeleted(Rezerwacje $rezerwacje)
    {
        //
    }
}
