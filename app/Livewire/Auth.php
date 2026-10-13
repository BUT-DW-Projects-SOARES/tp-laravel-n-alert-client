<?php

namespace App\Livewire;

use Livewire\Component;

class Auth extends Component
{

    public ?string $token;

    public function render()
    {
        return view('livewire.auth');
    }

    public function save() {}
}
