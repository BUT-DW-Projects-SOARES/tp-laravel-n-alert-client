<?php

namespace App\Livewire\Contact;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{

    #[Locked]
    public ?string $authToken = null;

    #[Validate('required')]
    public ?string $firstname = null;

    #[Validate('required')]
    public ?string $lastname = null;
    #[Validate('required|email')]
    public ?string $email = null;

    public function render()
    {
        return view('livewire.contact.create');
    }

    public function create()
    {
        $data = $this->validate();
        try {
            $me = Http::remote_api($this->authToken)
                ->get('/me')
                ->json();
            if ($me['role'] === 'customer' && $me['customer_id']) {
                $contact = Http::remote_api($this->authToken)
                    ->post('/customer/' . $me['customer_id'] . '/contact', $data)
                    ->json();
                $this->resetExcept('authToken');
                $this->dispatch('contact-created');
            }
        } catch (\Exception $e) {
        }
    }

    #[On('auth-token-updated')]
    public function authTokenUpdated(?string $token)
    {
        $this->authToken = $token;
    }
}
