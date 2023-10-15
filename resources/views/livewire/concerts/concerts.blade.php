<div>
    <div>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center justify-between pb-4 dark:bg-gray-900">
            <label for="table-search" class="sr-only">{{ __('web.search') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input wire:model.live.debounce.200ms="search" type="text" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('web.search') }}">
            </div>

            <div>
                <div class="flex items-center">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input wire:model="from" name="fromDate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                    </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input wire:model="to" name="toDate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                    </div>
                </div>
            </div>
        </div>

        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    @foreach(array_flip(__('web.concert_table_column_titles')) as $columnTitle)
                        <th scope="col" class="px-6 py-3 text-center justify-center">
                            {{ __('web.concert_table_column_titles.' . $columnTitle) }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                    @foreach($concerts as $concert)
                    <tr class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>

                        <th onclick="Livewire.dispatch('openModal', { component: 'show-concert', arguments: { id: {{ $concert->id }} }})" href="javascript:void(0)" scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white cursor-pointer hover:bg-gray-200 hover:rounded-2xl dark:hover:bg-gray-950">
                            <div class="pl-3">
                                <div class="text-base w-80 truncate font-semibold"> {{ $concert->event_name }} </div>
                                <div class="font-normal w-80 text-gray-500 truncate"> {{ $concert->description }} </div>
                            </div>
                        </th>

                        <td class="px-6 py-4">
                            <div class="pl-3">
                                <a href="/clubs/{{ $concert->club->id }}" class="text-base text-black dark:text-gray-400">
                                    {{ $concert->club->name }}
                                </a>
                                <div class="font-normal text-gray-500"> {{ $concert->club->location }} </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="pl-3">
                                <div class="font-medium text-gray-500 w-max"> {{ $concert->date }} </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="pl-3">
                                <div class="font-medium text-gray-500 w-max"> {{ $concert->setTime }} </div>
                                <div class="font-normal text-gray-500 w-max"> {{ $concert->setTimeDuration }} </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="pl-3 w-max">
                                <span class="mx-2">
                                @if(!empty($concert->facebook_event_url))
                                        <a href="{{ $concert->facebook_event_url }}" target="_blank">
                                        <i class="fa fa-facebook-square fa-lg"></i>
                                    </a>
                                    @endif
                                </span>

                                @if(!empty($concert->liveset_url))
                                    <a href="{{ $concert->liveset_url }}" target="_blank">
                                        <i class="fa fa-headphones fa-lg" aria-hidden="true"></i>
                                    </a>
                                @endif
                            </div>
                        </td>

                        <td class="px-3 py-4">
                            <div class="flex justify-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-{{ $concert->is_expired ? 'red' : 'green' }}-500 mr-2"></div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <button onclick="Livewire.dispatch('openModal', { component: 'edit-concert', arguments: { id: {{ $concert->id }} }})" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                {{ __('web.edit_details') }}
                            </button>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4 mb-2">
        {{ $concerts->links(data: ['scrollTo' => false]) }}
    </div>

</div>
