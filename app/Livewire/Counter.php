<?php

namespace App\Livewire;

use App\Livewire\Base\BaseComponent;
use App\Models\Barang;

class Counter extends BaseComponent
{
    public $count = 1;

    public $data = [];
 
    public function increment()
    {
        $this->count++;
    }
 
    public function decrement()
    {
        $this->count--;
    }

    public function save(){
        dd($this->all());
    }
 
    public function render()
    {
        $data['nama_barang'] = Barang::limit(10)->get();
        return view('livewire.counter', $data);
    }
}
