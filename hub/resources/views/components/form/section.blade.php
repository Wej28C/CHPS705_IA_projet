@props(['submit'])

<div class="mt-5 md:mt-0 md:col-span-2">
    <form wire:submit.prevent="{{ $submit }}">
        <div class="px-4 py-5 bg-white sm:p-6 rounded-tr-3xl rounded-tl-3xl">
            <div class="grid grid-cols-6 gap-6">
                {{ $form }}
            </div>
        </div>

        @if (isset($actions))
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow-lg rounded-br-3xl rounded-bl-3xl">
                {{ $actions }}
            </div>
        @endif
    </form>
</div>
