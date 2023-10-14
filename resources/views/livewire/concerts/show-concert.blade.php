<div class="dark:text-white text-black p-4">
    <table style="width: 100%">
        <tbody>
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex flex-col pb-3">
                        <dt class="mb-3 text-gray-500 md:text-lg dark:text-gray-400">{{ __('web.concert_modal_titles.event_name') }}</dt>
                        <dd class="text-sm">{{ $concert->event_name }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-3 text-gray-500 md:text-lg dark:text-gray-400">{{ __('web.concert_modal_titles.description') }}</dt>
                        <dd class="text-sm ">{{ $concert->description }}</dd>
                    </div>
                    <div class="flex flex-col py-3">
                        <dt class="mb-3 text-gray-500 md:text-lg dark:text-gray-400">{{ __('web.concert_modal_titles.location') }}</dt>
                        <dd class="text-sm">{{ $concert->club->name }}, {{ $concert->club->location }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-3 text-gray-500 md:text-lg dark:text-gray-400">{{ __('web.concert_modal_titles.added_by_user') }}</dt>
                        <dd class="text-sm">{{ $concert->author->name }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-3 text-gray-500 md:text-lg dark:text-gray-400">{{ __('web.concert_modal_titles.event_start_date') }}</dt>
                        <dd class="text-sm">{{ $concert->event_start_date }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-3 text-gray-500 md:text-lg dark:text-gray-400">{{ __('web.concert_modal_titles.event_end_date') }}</dt>
                        <dd class="text-sm">{{ $concert->event_end_date }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-3 text-gray-500 md:text-lg dark:text-gray-400">{{ __('web.concert_modal_titles.income') }}</dt>
                        <dd class="text-sm">{{ $concert->income . ' Ft' }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-3 text-gray-500 md:text-lg dark:text-gray-400">{{ __('web.concert_modal_titles.social_links') }}</dt>
                        <dd class="text-sm">
                            <a href="{{ $concert->facebook_event_url }}" target="_blank">
                                {{ $concert->facebook_event_url }}
                            </a>
                            <a href="{{ $concert->liveset_url }}" target="_blank">
                                {{ $concert->liveset_url }}
                            </a>
                        </dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-3 text-gray-500 md:text-lg dark:text-gray-400">{{ __('web.concert_modal_titles.logged') }}</dt>
                        <dd class="text-sm">{{ $concert->created_at }}</dd>
                    </div>

                </dl>
            </td>
            <td>
                @foreach($concert->getMedia() as $media)

                    <img alt="kep" src="{{ url('/api/image/concerts/' . $media->uuid) }}">
                @endforeach
                <!--
                url('/api/image/concerts/' . $this->resource->uuid)
                -->
            </td>
        </tr>
        </tbody>
    </table>
</div>
