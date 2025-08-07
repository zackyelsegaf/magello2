<?php

namespace App\View\Components\Form\Modul\Penjualan;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FooterAction extends Component
{
    /**
     * Create a new component instance.
     */
    public $routeCreate;
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.modul.penjualan.footer-action');
    }
}
