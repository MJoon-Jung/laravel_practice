<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $message;
    public $count = 0;

    public function product(){
        $this->count = $this->count*2;
        
    }

    public function increment(){
        $this->count++;
    }

    public function decrement(){
        $this->count--;
    }

    public function devide(){
        $this->count=$this->count/2;
    }

    

    public function render()
    {
        return view('livewire.counter');
    }
}
