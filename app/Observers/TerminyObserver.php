<?php

namespace App\Observers;

use App\Models\Rezerwacje;
use App\Models\Terminy;

class TerminyObserver
{
    /**
     * Handle the Terminy "created" event.
     *
     * @param  \App\Models\Terminy  $terminy
     * @return void
     */
    public function created(Terminy $terminy)
    {
        //
    }

    /**
     * Handle the Terminy "updated" event.
     *
     * @param  \App\Models\Terminy  $terminy
     * @return void
     */
    public function updated(Terminy $terminy)
    {

    }

    public function saved(Terminy $terminy)
    {
        if($terminy->status == 'wolny')
        {
            Rezerwacje::where('terminy_id', $terminy->id)->delete();
        }
    }

    /**
     * Handle the Terminy "deleted" event.
     *
     * @param  \App\Models\Terminy  $terminy
     * @return void
     */
    public function deleted(Terminy $terminy)
    {
        //
    }

    /**
     * Handle the Terminy "restored" event.
     *
     * @param  \App\Models\Terminy  $terminy
     * @return void
     */
    public function restored(Terminy $terminy)
    {
        //
    }

    /**
     * Handle the Terminy "force deleted" event.
     *
     * @param  \App\Models\Terminy  $terminy
     * @return void
     */
    public function forceDeleted(Terminy $terminy)
    {
        //
    }
}
