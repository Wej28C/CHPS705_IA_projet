<div class="container mx-auto p-4">
    <div x-data="{ show: false }" x-cloak>
        <!-- Bouton pour ouvrir le formulaire de création -->
        <button 
            @click="show = true" 
            class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-transform transform hover:scale-105">
            Ajouter un hôte
        </button>

        <!-- Formulaire de création -->
        <div
            class="fixed inset-0 bg-gray-900 bg-opacity-80 flex items-center justify-center transition ease-in-out duration-300 z-50"
            x-transition.opacity
            x-show="show"
            x-on:host-created.window="show = false">
            <div 
                class="bg-gray-800 p-8 rounded-lg shadow-2xl w-1/3 relative text-gray-200"
                x-on:click.outside="show = false">
                <h2 class="text-2xl font-semibold text-orange-400 mb-4">Créer un nouvel hôte</h2>
                <form wire:submit.prevent="createHost">
                    <!-- Nom -->
                    <label class="block text-sm font-medium mb-1" for="name">Nom</label>
                    <input 
                        type="text" 
                        id="name" 
                        wire:model="createHostForm.name" 
                        class="bg-gray-700 border border-gray-600 focus:ring-orange-500 focus:border-orange-500 rounded-lg p-3 w-full mb-4 text-gray-200 placeholder-gray-400"
                        placeholder="Entrez le nom de l'hôte">
                    <x-input-error for="name" class="mb-2" />

                    <!-- Adresse IP -->
                    <label class="block text-sm font-medium mb-1" for="ip">Adresse IP</label>
                    <input 
                        type="text" 
                        id="ip" 
                        wire:model="createHostForm.ip" 
                        class="bg-gray-700 border border-gray-600 focus:ring-orange-500 focus:border-orange-500 rounded-lg p-3 w-full mb-4 text-gray-200 placeholder-gray-400"
                        placeholder="Entrez l'adresse IP">
                    <x-input-error for="ip" class="mb-2" />

                    <!-- Port -->
                    <label class="block text-sm font-medium mb-1" for="port">Port</label>
                    <input 
                        type="text" 
                        id="port" 
                        wire:model="createHostForm.port" 
                        class="bg-gray-700 border border-gray-600 focus:ring-orange-500 focus:border-orange-500 rounded-lg p-3 w-full mb-4 text-gray-200 placeholder-gray-400"
                        placeholder="Entrez le port">
                    <x-input-error for="port" class="mb-2" />

                    <!-- Sélection du Jeu -->
                    <label class="block text-sm font-medium mb-1" for="game_id">Jeu</label>
                    <select 
                        id="game_id" 
                        wire:model="createHostForm.game_id" 
                        class="bg-gray-700 border border-gray-600 focus:ring-orange-500 focus:border-orange-500 rounded-lg p-3 w-full mb-4 text-gray-200">
                        <option value="">-- Sélectionnez un jeu --</option>
                        @foreach ($this->games as $game)
                            <option value="{{ $game->id }}">{{ $game->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="game_id" class="mb-2" />

                    <!-- Bouton de soumission -->
                    <button 
                        type="submit" 
                        class="bg-orange-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded-lg shadow-md w-full transition-transform transform hover:scale-105">
                        Créer
                    </button>
                </form>
            </div>
        </div>

        <!-- Liste des hôtes -->
        <div class="mt-6 bg-gray-800 p-6 rounded-lg shadow-lg text-gray-200">
            <h2 class="text-lg font-semibold text-orange-400 mb-4">Liste des hôtes</h2>
            <table class="table-auto w-full border-collapse border border-gray-700 rounded-lg">
                <thead>
                    <tr class="bg-gray-700 text-gray-200">
                        <th class="px-4 py-3 border border-gray-600">Nom</th>
                        <th class="px-4 py-3 border border-gray-600">Adresse IP</th>
                        <th class="px-4 py-3 border border-gray-600">Port</th>
                        <th class="px-4 py-3 border border-gray-600">Jeu</th>
                        <th class="px-4 py-3 border border-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->hosts as $host)
                        <tr class="bg-gray-800">
                            <td class="border px-4 py-2 text-gray-200 border-gray-700">{{ $host->name }}</td>
                            <td class="border px-4 py-2 text-gray-200 border-gray-700">{{ $host->ip }}</td>
                            <td class="border px-4 py-2 text-gray-200 border-gray-700">{{ $host->port }}</td>
                            <td class="border px-4 py-2 text-gray-200 border-gray-700">{{ $host->game->name }}</td>
                            <td class="border px-4 py-2 border-gray-700">
                                <x-form.delete-button 
                                    title="Confirmer la suppression de '{{ $host->name }}'"
                                    clickEvent="deleteHost({{ $host->id }})" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $this->hosts->links() }}
            </div>
        </div>
    </div>
</div>
