<?php

namespace App\Livewire\Alert;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Listing extends Component
{
    public ?string $authToken = null;

    public function render()
    {
        $alerts = [];
        if (!empty($this->authToken)) {
            $alerts = Http::withToken($this->authToken)
                ->get('https://laravel.issler.ens.mmi-unistra.fr/alert/public/api/alert')
                ->json();
        }
        return view('livewire.alert.listing', ['alerts' => $alerts]);
    }

    #[On('auth-token-updated')]
    public function authTokenUpdated(?string $token)
    {
        $this->authToken = $token;
    }
}
