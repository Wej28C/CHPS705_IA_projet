@props([
    'title' => 'Confirmation de Suppression', 
    'description' => 'Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.',
    'clickEvent' => '' 
])

<div x-data="{ showModal: false }">
    <button 
        {{ $attributes->merge(['class' => "bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded shadow-md transition-transform transform hover:scale-105"]) }}
        x-on:click="showModal = true">
        Supprimer
    </button>

    <!-- Modal -->
    <div 
        class="fixed inset-0 bg-gray-900 bg-opacity-80 backdrop-blur-sm flex items-center justify-center z-50 p-4"
        x-show="showModal"
        x-transition
        x-cloak>
        <div 
            class="bg-gray-800 text-gray-200 rounded-lg shadow-xl w-full max-w-lg p-6 relative transform transition-all"
            x-on:click.outside="showModal = false">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-orange-400">
                    {{ $title }}
                </h3>
                <div 
                    class="flex items-center justify-center h-10 w-10 rounded-full bg-red-700 text-white hover:bg-red-600 cursor-pointer"
                    x-on:click="showModal = false">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
            <!-- Body -->
            <div class="mb-6">
                <p class="text-sm">
                    {{ $description }}
                </p>
            </div>
            <!-- Footer -->
            <div class="flex justify-end space-x-4">
                <button 
                    type="button" 
                    class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded-md shadow-md transition-transform transform hover:scale-105"
                    wire:click="{{ $clickEvent }}"
                    x-on:click="showModal = false">
                    Supprimer
                </button>
                <button 
                    type="button" 
                    class="bg-gray-700 hover:bg-gray-600 text-gray-200 font-bold py-2 px-4 rounded-md shadow-md transition-transform transform hover:scale-105"
                    x-on:click="showModal = false">
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>
