<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-gray-800 text-white shadow-lg overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
