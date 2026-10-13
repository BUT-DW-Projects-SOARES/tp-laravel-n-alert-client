<?php

namespace App\Livewire\Alert;

use Livewire\Attributes\On;
use Livewire\Component;

class Listing extends Component
{
    public bool $hasToken = false;

    public function render()
    {
        return view('livewire.alert.listing');
    }

    #[On('auth-token-updated')]
    public function authTokenUpdated(?string $token)
    {
        $this->hasToken = !empty($token);
    }
}
