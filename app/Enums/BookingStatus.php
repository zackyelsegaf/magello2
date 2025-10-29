<?php

namespace App\Enums;

enum BookingStatus: int
{
    case PEMBERKASAN=0; 
    case PROSES=1; 
    case ANALISA_BANK=2; 
    case SP3K=3;
    case AKAD_KREDIT=4; 
    case AJB=5; 
    case DITOLAK=6; 
    case MUNDUR=7;
}
