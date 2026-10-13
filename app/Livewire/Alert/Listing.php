<?php

namespace App\Livewire\Alert;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Listing extends Component
{
    #[Locked]
    public ?string $authToken = null;

    public function render()
    {
        $alerts = [];
        $errors = [];
        if (!empty($this->authToken)) {
            try {
                $alerts = Http::throw()
                    ->baseUrl(config('remote_api.base_url'))
                    ->withToken($this->authToken)
                    ->get('/alert')
                    ->json();
            } catch (ConnectionException $e) {
                $errors[] = 'can\'t connect';
            } catch (RequestException $e) {
                if ($e->response->notFound()) {
                    $errors[] = 'not found';
                } elseif ($e->response->unauthorized() || $e->response->forbidden()) {
                    $errors[] = 'bad auth';
                } else {
                    $errors[] = 'unknown error';
                }
            }
        }
        return view('livewire.alert.listing', ['alerts' => $alerts, 'errors' => $errors]);
    }

    #[On('auth-token-updated')]
    public function authTokenUpdated(?string $token)
    {
        $this->authToken = $token;
    }
}
