<div
    x-data="{
        showPopup: false 
    }"
    class="fixed inset-0 bg-gray-900 bg-opacity-75 h-full w-full flex items-center justify-center p-4 backdrop-filter backdrop-blur-sm" 
    x-show="showPopup"
    x-transition
    x-on:{{ $showPopupNameEvent }}.window="showPopup = true; $nextTick(() => $refs.scrollContainer.scrollTop = 0);"
    x-cloak
    @if(isset($closePopupNameEvent))
        x-on:{{ $closePopupNameEvent }}.window="showPopup = false"
    @endif>
    <div
        class="bg-white rounded-lg shadow-xl transform transition-all min-w-lg overflow-y-auto overflow-x-auto max-h-full"
        x-on:click.outside="showPopup = false"
        x-ref="scrollContainer">
        <div class="bg-white px-4 pt-5 pb-4">
            <div class="flex flex-row items-center">
                <!-- Icone Croix -->
                <div class="mx-0 flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:h-10 sm:w-10 text-red-600 hover:text-white hover:cursor-pointer hover:bg-red-300"
                    x-on:click="showPopup=false">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div class="w-full text-center mx-4 text-lg font-semibold">
                    {{ $title }}
                </div>
            </div>
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
