<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
    public $currentPage;

    public function boot()
    {
        $this->currentPage = Route::currentRouteName();
    }

    public function render()
    {
        return view('livewire.sidebar');
    }

    public function home()
    {
        return redirect()->to('');
    }

    public function concerts()
    {
        return redirect()->to('concerts');
    }

    public function clubs()
    {
        return redirect()->to('clubs');
    }

    public function profile()
    {
        return redirect()->to('profile');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('');
    }
}
