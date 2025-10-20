<?php

namespace App\Observers;

use App\Models\Kapling;

class KaplingObserver
{
    /**
     * Handle the Kapling "created" event.
     */
    public function created(Kapling $kapling): void
    {
        if ($kapling) {
            $kapling->status_penjualan   = 'Siap Jual';
            $kapling->status_pembangunan = 'Kapling Kosong';
            $kapling->save();
        }

    }

    /**
     * Handle the Kapling "updated" event.
     */
    public function updated(Kapling $kapling): void
    {
        //
    }

    /**
     * Handle the Kapling "deleted" event.
     */
    public function deleted(Kapling $kapling): void
    {
        //
    }

    /**
     * Handle the Kapling "restored" event.
     */
    public function restored(Kapling $kapling): void
    {
        //
    }

    /**
     * Handle the Kapling "force deleted" event.
     */
    public function forceDeleted(Kapling $kapling): void
    {
        //
    }
}
