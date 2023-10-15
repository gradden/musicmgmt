<?php

namespace App\Livewire;

use App\Exceptions\AuthorizationException;
use App\Exceptions\EmailVerificationException;
use App\Services\AuthService;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required')]
    public string $email;

    #[Rule('required')]
    public string $password;

    public string $title = 'Login';

    private AuthService $authService;

    public function boot(
        AuthService $authService
    ): void {
        $this->authService = $authService;
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
        } catch (AuthorizationException $e) {
            return $this->addError('loginFailed', __('errors.wrong_credentials'));
        } catch (EmailVerificationException $e) {
            return $this->addError('loginFailed', __('errors.email_verification'));
        }
    }

    private function validateInputs()
    {
        $this->validate([
            'email' => 'required'
        ]);
    }
}
