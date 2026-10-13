<?php

namespace App\Livewire\Alert;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Listing extends Component
{
    public bool $hasToken = false;

    public array $alerts = [];

    public function render()
    {
        return view('livewire.alert.listing');
    }

    #[On('auth-token-updated')]
    public function authTokenUpdated(?string $token)
    {
        $this->hasToken = !empty($token);

        if ($this->hasToken) {
            $response = Http::withToken($token)
                ->get('https://laravel.issler.ens.mmi-unistra.fr/alert/public/api/alert')
                ->json();
            $this->alerts = $response;
        } else {
            $this->alerts = [];
        }
    }
}
