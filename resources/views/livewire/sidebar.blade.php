<div>
    <!--
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>
    -->

    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <div class="mb-8 mt-5 text-center">
                    <h1 class="text-3xl text-black dark:text-white  ">MusicMGMT</h1>
                </div>
            </ul>
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                @foreach(config('menus.main_menus') as $menu)
                    <li>
                        <a @if($currentPage != $menu) wire:click.prevent="{{ $menu }}" @endif href="javascript:void(0)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white {{ ($currentPage == $menu) ? 'bg-gray-300 dark:bg-gray-900' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                            <i class="fa {{ config('menus.fa_icons.' . $menu) }} fa-6 w-5 h-5 text-gray-500 transition duration-75 {{ ($currentPage == $menu) ? 'text-black dark:text-white' : 'group-hover:text-gray-900 dark:group-hover:text-white' }} dark:text-gray-400" aria-hidden="true"></i>
                            <span class="ml-3"> {{ __('web.' . $menu) }} </span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                @foreach(config('menus.action_menus') as $menu)
                    <li>
                        <a @if($currentPage != $menu) wire:click.prevent="{{ $menu }}" @endif href="javascript:void(0)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white {{ ($currentPage == $menu) ? 'bg-gray-300 dark:bg-gray-900' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                            @if($menu == 'profile')
                                @php
                                    $uuid = null;
                                    foreach (auth()->user()->getMedia() as $media) {
                                        if ($media->hasCustomProperty('profilePicture')) {
                                            if ($media->getCustomProperty('profilePicture')) {
                                                $uuid = $media->uuid;
                                            }
                                        }
                                    }
                                @endphp
                                <div class="w-6 h-6 rounded-full cursor-pointer overflow-hidden border rounded-div-profile"></div>
                            @else
                                <i class="fa {{ config('menus.fa_icons.' . $menu) }} fa-6 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true"></i>
                            @endif
                            <span class="ml-3"> {{ __('web.' . $menu) }} </span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                <li>
                    <button id="theme-toggle" type="button" class="focus:outline-none focus:ring-4 focus:ring-gray-200 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                        <span class="ml-3 items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"> Switch mode </span>
                    </button>
                </li>
            </ul>
        </div>
    </aside>
</div>