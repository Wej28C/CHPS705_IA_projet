<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                Matchmaking
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-4 lg:px-6">
            <div class="">
                @livewire('Matchmaking')
            </div>
        </div>
    </div>
</x-app-layout>