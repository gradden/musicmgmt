<?php

namespace App\Livewire;

use App\Services\AuthService;
use App\Services\CookieService;
use Exception;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required')]
    public string $email;

    #[Rule('required')]
    public string $password;

    public string $title = 'Login';

    private AuthService $authService;
    private CookieService $cookieService;

    public function boot(
        AuthService $authService,
        CookieService $cookieService
    ): void {
        $this->authService = $authService;
        $this->cookieService = $cookieService;
    }

    public function render()
    {
        return view('livewire.login');
    }

    public function login()
    {
        try {
            $this->validateInputs();

            $this->authService->auth([
                'email' => $this->email,
                'password' => $this->password
            ]);

            return redirect('/');
        } catch (Exception $e) {
            return $this->addError('loginFailed', __('errors.wrong_credentials'));
        }
    }

    private function validateInputs()
    {
        $this->validate([
            'email' => 'required'
        ]);
    }
}
