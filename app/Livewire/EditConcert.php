<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditConcert extends ModalComponent
{
    public function render()
    {
        return view('livewire.concerts.edit-concert');
    }
}
