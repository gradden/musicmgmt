<?php

namespace App\Livewire;

use App\Enums\StatusEnum;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $passwordConfirm;
    public $language;

    public function mount()
    {
        $user = auth()->user();
        $this->firstname = $user->firstName;
        $this->lastname = $user->lastName;
        $this->email = $user->email;
        $this->language = $user->locale;
    }

    public function render()
    {
        return view('livewire.profile', [
            'user' => auth()->user()
        ]);
    }

    public function updateProfile()
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();

            if (($this->firstname . ' ' . $this->lastname) !== $user->name) {
                $user->name = $this->firstname . ' ' . $this->lastname;
            }

            if ($this->email !== $user->email) {
                $user->email = $this->email;
            }

            if (!empty($this->password) && !empty($this->passwordConfirm)) {
                if ($this->password === $this->passwordConfirm) {
                    $user->password = Hash::make($this->password);
                }
            }

            if ($user->locale !== $this->language) {
                $user->locale = $this->language;
                app()->setLocale($this->language);
            }

            $user->save();

            session()->flash('alert_message', __('web.profile_page.update_successful'));
            session()->flash('status', StatusEnum::OK);

            DB::commit();
        } catch (Exception) {
            DB::rollBack();

            session()->flash('alert_message', __('web.profile_page.update_fail'));
            session()->flash('status', StatusEnum::FAIL);
        }

        return redirect('profile');
    }
}
