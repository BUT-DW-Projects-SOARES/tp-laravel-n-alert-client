<?php

namespace App\Livewire;

use Livewire\Component;

class Auth extends Component
{

    public ?string $token = null;

    public function render()
    {
        return view('livewire.auth');
    }

    public function save()
    {
        $this->dispatch('auth-token-updated', $this->token);
    }
}
