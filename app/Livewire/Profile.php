<?php

namespace App\Livewire;

use App\Enums\StatusEnum;
use App\Services\FileService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $passwordConfirm;
    public $profilepicture;
    public $language;

    private FileService $fileService;

    public function boot(FileService $fileService) {
        $this->fileService = $fileService;
    }

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
        } catch (Exception $e) {
            DB::rollBack();

            session()->flash('alert_message', __('web.profile_page.update_fail'));
            session()->flash('status', StatusEnum::FAIL);
        }

        return redirect('profile');
    }

    public function updatedProfilepicture()
    {
        $this->uploadPhoto('profile_picture', $this->profilepicture);
    }

    public function uploadPhoto(string $type, $photo): void
    {
            $this->validate([
                'profilepicture' => 'image|mimes:jpg,jpeg,bmp,png',
            ]);

            $this->fileService->deletePreviousIfExists(Str::camel($type));

            $user = auth()->user();

            $filename = $type . '_' .
                $user->id . '_' .
                Carbon::now()->format('Ymdhis') . '_' .
                Str::random(8);

            $filename .= '.' . explode('.', $photo->getFilename())[1];

            $user
                ->addMedia($photo->getRealpath())
                ->usingFileName($filename)
                ->withCustomProperties([Str::camel($type) => true])
                ->toMediaCollection();

    }
}
