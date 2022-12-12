<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">

            <!-- колонка -->
            @foreach($events as $event)
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                <article class="overflow-hidden rounded-lg shadow-lg">

                    <a href="#">
                        <img alt="Placeholder" class="block h-auto w-full" src="images/vdnh.jpg">
                    </a>

                    <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                        <h1 class="text-lg">
                            <a class="no-underline hover:underline text-black" href="#">
                                Встреча на ВДНХ
                            </a>
                        </h1>
                        <p class="text-grey-darker text-sm">
                            {{ $event->start_event }}
                        </p>
                    </header>

                    <div class="p-2 md:p-4">
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            Встечаемся на ВДНХ у памятника "Рабочей и Колхознице" и знакомимся...
                        </p>
                        <p class="text-grey-darker text-sm">
                            Кол-во участников: {{ count($event->users) }} <br> Девушек - {{ count($event->users()->where('sex', 'female')->get()) }} <br> Парней - {{ count($event->users()->where('sex', 'male')->get()) }}
                        </p>
                    </div>

                    <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                        <form method="post" action="{{ route('submitEvent')  }}">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <button class="@if(!$event->users->contains(\Auth::id()) )bg-blue-500 @else bg-red-500 @endif hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                @if(!$event->users->contains(\Auth::id()))
                                    Иду на встречу
                                @else
                                    Я передумал
                                @endif
                            </button>
                        </form>
                    </footer>
                </article>
            </div>
            @endforeach

        </div>
    </div>

</x-app-layout>
