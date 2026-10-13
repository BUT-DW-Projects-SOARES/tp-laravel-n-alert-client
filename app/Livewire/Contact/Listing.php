<?php

namespace App\Livewire\Contact;

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
        $errors = [];
        $contacts = [];
        if (!empty($this->authToken)) {
            try {
                $me = Http::remote_api($this->authToken)
                    ->get('/me')
                    ->json();
                if ($me['role'] === 'customer' && $me['customer_id']) {
                    $contacts = Http::remote_api($this->authToken)
                        ->get('/customer/' . $me['customer_id'] . '/contact')
                        ->json()['data'];
                }
            } catch (ConnectionException $e) {
                $errors[] = 'can\'t connect';
            } catch (RequestException $e) {
                if ($e->response->notFound()) {
                    dump($e->response);
                    $errors[] = 'not found';
                } elseif ($e->response->unauthorized() || $e->response->forbidden()) {
                    $errors[] = 'bad auth';
                } else {
                    $errors[] = 'unknown error';
                }
            }
        }

        return view('livewire.contact.listing', ['contacts' => $contacts, 'errors' => $errors]);
    }

    #[On('auth-token-updated')]
    public function authTokenUpdated(?string $token)
    {
        $this->authToken = $token;
    }
}
