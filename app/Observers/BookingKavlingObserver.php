<?php

namespace App\Observers;

use App\Models\BookingKavling;

class BookingKavlingObserver
{
    /**
     * Handle the BookingKavling "created" event.
     */
    public function created(BookingKavling $bookingKavling): void
    {
        $bookingKavling->kapling()->update([
            'status_penjualan'   => 'Terbooking',
            'status_pembangunan' => 'Kapling Kosong',
        ]);
    }

    /**
     * Handle the BookingKavling "updated" event.
     */
    public function updated(BookingKavling $bookingKavling): void
    {
        $status = $bookingKavling->status_pengajuan;

        if (in_array($status, ['dibatalkan','expired'])) {
            $bookingKavling->kapling()->update([
                'status_penjualan' => 'Siap Jual',
            ]);
        } elseif ($status === 'disetujui') {
            $bookingKavling->kapling()->update([
                'status_penjualan' => 'Terjual',
            ]);
        }
    }

    /**
     * Handle the BookingKavling "deleted" event.
     */
    public function deleted(BookingKavling $bookingKavling): void
    {
        $bookingKavling->kapling()->update([
            'status_penjualan' => 'Siap Jual',
        ]);
    }

    /**
     * Handle the BookingKavling "restored" event.
     */
    public function restored(BookingKavling $bookingKavling): void
    {
        //
    }

    /**
     * Handle the BookingKavling "force deleted" event.
     */
    public function forceDeleted(BookingKavling $bookingKavling): void
    {
        //
    }
}
