<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <ul role="list" class="space-y-6"     x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-activity-log', package: 'marvinosswald/filament-activity-log'))]">
        @foreach($getState()->sortBy([['id', 'desc'], ['created_at', 'desc']]) as $activity)
            <li class="relative flex gap-x-4">
                @if ($loop->last)
                    <div class="absolute left-0 top-0 flex w-6 justify-center h-6">
                        <div class="w-px bg-gray-200 dark:bg-gray-500"></div>
                    </div>
                @else
                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                        <div class="w-px bg-gray-200 dark:bg-gray-500"></div>
                    </div>
                @endif
                <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-gray-50 dark:bg-gray-950">
                    @switch($activity->event)
                        @case('created')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @break
                        @default
                            <div class="relative flex h-6 w-6 flex-none items-center justify-center ">
                                <div class="h-1.5 w-1.5 rounded-full bg-gray-100 dark:bg-gray-400 ring-1 ring-gray-300 dark:ring-gray-500"></div>
                            </div>
                            @break
                    @endswitch
                </div>
                <div class="flex flex-col">
                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500">
                        <span class="font-medium dark:text-gray-100 text-gray-900">{{$getCauser($activity)}}</span> {{$activity->event}} {{$getSubject($activity)}}.
                    </p>
                    @if($activity->event === 'updated')
                        @foreach($getDiff($activity) as $key => $diff)
                            @if($diff->to === null)
                                <span class="inline-flex items-center rounded-md bg-red-400/10 px-2 py-1 text-xs font-medium text-red-400 ring-1 ring-inset ring-red-400/20">
                                        {{$key}}: {{$diff->from}}
                                    </span>
                            @elseif($diff->from === null)
                                <span class="inline-flex items-center rounded-md bg-green-500/10 px-2 py-1 text-xs font-medium text-green-400 ring-1 ring-inset ring-green-500/20">
                                        {{$key}}: {{$diff->to}}
                                    </span>
                            @else
                                <span class="inline-flex items-center rounded-md bg-blue-400/10 px-2 py-1 text-xs font-medium text-blue-400 ring-1 ring-inset ring-blue-400/30">
                                        {{$key}}: {{$diff->from}} -> {{$diff->to}}
                                    </span>
                            @endif
                        @endforeach
                    @endif
                    @if($activity->description != $activity->event)
                        <div class="border-l-2 border-gray-500 mt-2">
                            <blockquote class="pl-2 text-xs font-semibold leading-8 tracking-tight text-gray-900 dark:text-gray-100">
                                <p>“{{$activity->description}}”</p>
                            </blockquote>
                        </div>
                    @endif
                </div>
                <time datetime="{{$activity->created_at}}" class="flex-none py-0.5 text-xs leading-5 text-gray-500">{{$activity->created_at?->diffForHumans()}}</time>
            </li>
        @endforeach
    </ul>
{{--    <div class="mt-6 flex gap-x-3">--}}
{{--        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-6 w-6 flex-none rounded-full bg-gray-50">--}}
{{--        <form action="#" class="relative flex-auto">--}}
{{--            <div class="px-2 overflow-hidden rounded-lg pb-12 shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">--}}
{{--                <label for="comment" class="sr-only">Add your comment</label>--}}
{{--                <textarea rows="2" name="comment" id="comment" class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 dark:text-gray-100" placeholder="Add your comment..."></textarea>--}}
{{--            </div>--}}

{{--            <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">--}}
{{--                <div class="flex items-center space-x-5">--}}
{{--                </div>--}}
{{--                <button type="submit" class="rounded-md bg-white dark:bg-black dark:text-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">Comment</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
</x-dynamic-component>
