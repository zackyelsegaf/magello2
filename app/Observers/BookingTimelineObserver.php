<?php

namespace App\Observers;

use App\Models\BookingTimeline;

class BookingTimelineObserver
{
    /**
     * Handle the BookingTimeline "created" event.
     */
    public function created(BookingTimeline $bookingTimeline): void
    {
        // if ($bookingTimeline->is_current) {
        //     $bookingTimeline->booking()->update([
        //         'current_status_code' => $bookingTimeline->status_code,
        //     ]);
        // }
    }

    /**
     * Handle the BookingTimeline "updated" event.
     */
    public function updated(BookingTimeline $bookingTimeline): void
    {
        //
    }

    /**
     * Handle the BookingTimeline "deleted" event.
     */
    public function deleted(BookingTimeline $bookingTimeline): void
    {
        //
    }

    /**
     * Handle the BookingTimeline "restored" event.
     */
    public function restored(BookingTimeline $bookingTimeline): void
    {
        //
    }

    /**
     * Handle the BookingTimeline "force deleted" event.
     */
    public function forceDeleted(BookingTimeline $bookingTimeline): void
    {
        //
    }
}
