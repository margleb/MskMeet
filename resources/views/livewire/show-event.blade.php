<div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
    <article class="overflow-hidden rounded-lg shadow-lg">

        <a href="#">
            <img alt="Placeholder" class="block h-auto w-full" src="{{ $event->location->image }}">
        </a>

        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
            <h1 class="text-lg">
                <a class="no-underline hover:underline text-black" href="#">
                    {{ $event->location->title }}
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
                Кол-во участников: {{ $this->people }} <br> Девушек - {{ $this->female }}  <br> Парней - {{ $this->male }}
            </p>
        </div>

        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                <button wire:click="toggle_meet" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        {{ $toggleButton ? 'Я не приду' : 'Приду на встречу' }}
                </button>
        </footer>
    </article>
</div>

