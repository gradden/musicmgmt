<div>
    <div class="relative mx-auto px-4 dark:text-white text-black rounded-md dark:bg-gray-800 bg-gray-200">
        <div class="h-screen py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <form wire:submit.prevent="updateProfile">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">PROF PIC UPLOADER HERE</h2>
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('web.profile_page.first_name') }}</label>
                        <input type="text"
                               name="firstname"
                               id="firstname"
                               value="{{ $user->first_name }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="{{ __('web.profile_page.first_name') }}"
                               required
                               wire:model="firstname"
                        >
                    </div>
                    <div class="w-full">
                        <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('web.profile_page.last_name') }}</label>
                        <input type="text"
                               name="lastname"
                               id="lastname"
                               value="{{ $user->last_name }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="{{ __('web.profile_page.first_name') }}"
                               required
                               wire:model="lastname"
                        >
                    </div>
                    <div class="w-full">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
                        <div class="relative text-gray-600 focus-within:text-gray-400">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2" data-tooltip-target="email-is-verified">
                                @if($user->isVerified)
                                    <i class="fa fa-check-circle" style="color: green" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-exclamation-triangle" style="color: darkorange" aria-hidden="true"></i>
                                @endif
                            </span>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="pl-8 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="{{ __('web.profile_page.first_name') }}"
                                   value="{{ $user->email }}"
                                   required
                                   wire:model="email"
                            >
                        </div>
                        <div id="email-is-verified" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            @if($user->isVerified)
                                {{ __('web.profile_page.verified_email') }}
                            @else
                                {{ __('web.profile_page.not_verified_email') }}
                            @endif
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                    <div class="w-full">
                        <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">{{ __('web.profile_page.roles') }}</h2>
                        <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                            @foreach($user->getRoleNames() as $role)
                                <li>
                                    {{ mb_strtoupper($role) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="w-full">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('web.profile_page.password') }}</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="{{ __('web.profile_page.password') }}"
                               wire:model="password"
                               >
                    </div>
                    <div class="w-full">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('web.profile_page.password') }}</label>
                        <input type="password"
                               name="password_confirm"
                               id="password_confirm"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="{{ __('web.profile_page.password_confirm') }}"
                               wire:model="passwordConfirm"
                               >
                    </div>
                    <div class="w-full">
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('web.profile_page.select_language') }}</label>
                        <select wire:model="language" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach (array_flip(config('app.languages')) as $language)
                                <option @if(auth()->user()->locale === $language) selected @endif value="{{ $language }}"> {{ config('app.languages.' . $language) }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="mt-8 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    {{ __('web.profile_page.update') }}
                </button>
            </form>
        </div>
    </div>
</div>
