<?php

namespace App\View\Components\form;

use Closure;
use App\Models\MataUang;
use App\Models\Pelanggan;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class FilterForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data['pelanggans'] = Pelanggan::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->nama_pelanggan];
        })->toArray();

        $data['matauangs'] =  MataUang::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->nama];
        })->toArray();
        return view('components.form.filter-form', $data);
    }
}
