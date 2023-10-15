<nav aria-label="Paginator">
    <ul class="inline-flex -space-x-px text-base h-10">
        <li>
            @if($paginator->onFirstPage())
                <span class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    {{ __('web.previous') }}
                </span>
            @else
                <button wire:click="previousPage" class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    {{ __('web.previous') }}
                </button>
            @endif
        </li>

        @for($count = 1; $count <= $paginator->lastPage(); $count++)
            <li>
                @if($paginator->currentPage() == $count)
                    <button aria-current="page" class="flex items-center justify-center px-4 h-10 leading-tight text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                        {{ $count }}
                    </button>
                @else
                    <button wire:click="gotoPage({{ $count }})" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        {{ $count }}
                    </button>
                @endif
            </li>
        @endfor

        @if(!$paginator->hasMorePages())
            <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                {{ __('web.next') }}
            </span>
        @else
            <button wire:click="nextPage" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                {{ __('web.next') }}
            </button>
        @endif
    </ul>
</nav>

