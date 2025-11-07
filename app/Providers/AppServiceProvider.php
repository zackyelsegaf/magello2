<?php

namespace App\Providers;

use App\Models\ArsipFile;
use App\Models\Kapling;
use App\Models\Fasum;
use App\Models\User;
use App\Models\Fasos;
use App\Models\BookingKavling;
use App\Models\DokumenBooking;
use App\Models\BookingTimeline;
use App\Models\BookingStatus0Pemberkasan;
use App\Models\BookingStatus1Proses;
use App\Models\BookingStatus2AnalisaBank;
use App\Models\BookingStatus3Sp3k;
use App\Models\BookingStatus4AkadKredit;
use App\Models\BookingStatus5Ajb;
use App\Models\BookingStatus6DitolakBank;
use App\Models\BookingStatus7Mundur;
use App\Models\PembayaranBookingKonsumen;
use App\Models\SuratPerintahKerjaInternal;
use App\Observers\BookingKavlingObserver;
use App\Observers\BookingTimelineObserver;
use App\Observers\KaplingObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auth::loginUsingId(64);
        // Auth::loginUsingId(15);
        BookingKavling::observe(BookingKavlingObserver::class);
        Kapling::observe(KaplingObserver::class);
        BookingTimeline::observe(BookingTimelineObserver::class);

        Relation::enforceMorphMap([
            'pemberkasan'  => BookingStatus0Pemberkasan::class,
            'proses'       => BookingStatus1Proses::class,
            'analisa_bank' => BookingStatus2AnalisaBank::class,
            'sp3k'         => BookingStatus3Sp3k::class,
            'akad_kredit'  => BookingStatus4AkadKredit::class,
            'ajb'          => BookingStatus5Ajb::class,
            'ditolak_bank' => BookingStatus6DitolakBank::class,
            'mundur'       => BookingStatus7Mundur::class,
            'kapling'      => Kapling::class,
            'fasum'        => Fasum::class,
            'fasos'        => Fasos::class,
            'booking'      => BookingKavling::class,
            'dokumen_booking' => DokumenBooking::class,
            'spk_internal' => SuratPerintahKerjaInternal::class,
            'arsip_file'      => ArsipFile::class,
            'pembayaran_booking' => PembayaranBookingKonsumen::class,
            'users' => User::class,
        ]);
    }
}
