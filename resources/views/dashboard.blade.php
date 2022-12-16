
@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

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
                <livewire:show-event :event="$event" />
            @endforeach

        </div>
    </div>

</x-app-layout>
