<div class="container mx-auto p-4">
    <div x-cloak>
        <!-- Popup affichant les instances -->
        <div 
            class="fixed inset-0 bg-gray-900 bg-opacity-80 flex items-center justify-center transition ease-in-out duration-300"
            x-transition.opacity    
            x-data="{ show: false }" 
            x-show="show"
            x-on:view_more.window="show = true;"
            >
            <div class="bg-gray-800 rounded-lg shadow-2xl w-3/4 max-h-3/4 p-6 overflow-y-auto text-gray-200"
            x-on:click.outside="show=false;">
                <h2 class="text-xl font-semibold text-orange-500 text-center mb-4">Instances de jeu</h2>
                <table class="table-auto w-full border-collapse border border-gray-700 rounded-lg">
                    <thead>
                        <tr class="bg-gray-700 text-gray-200">
                            <th class="px-4 py-3 border border-gray-600">ID</th>
                            <th class="px-4 py-3 border border-gray-600">Créé à</th>
                            <th class="px-4 py-3 border border-gray-600">Joueur Humain</th>
                            <th class="px-4 py-3 border border-gray-600">Joueur IA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="instance in $wire.instances">
                            <tr class="bg-gray-800" x-init="console.log(instance)">
                                <td class="border px-4 py-2 text-black-200 border-gray-700" x-text="instance.id"></td>
                                <td class="border px-4 py-2 text-gray-200 border-gray-700" x-text="instance.created_at"></td>
                                <td class="border px-4 py-2 text-gray-200 border-gray-700">
                                    <template x-if="instance.users && instance.users.length > 0">
                                        <ul class="list-disc pl-4">
                                            <template x-for="user in instance.users">
                                                <li x-text="user.name"></li>
                                            </template>
                                        </ul>
                                    </template>
                                    <template x-if="!instance.users || instance.users.length === 0">
                                        <span class="italic text-gray-400">Aucun joueur</span>
                                    </template>
                                </td>
                                <td class="border px-4 py-2 text-gray-200 border-gray-700">
                                    <template x-if="instance.robots && instance.robots.length > 0">
                                        <ul class="list-disc pl-4">
                                            <template x-for="user in instance.users">
                                                <li x-text="user.name"></li>
                                            </template>
                                        </ul>
                                    </template>
                                    <template x-if="!instance.robots || instance.robots.length === 0">
                                        <span class="italic text-gray-400">Aucune IA</span>
                                    </template>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <button 
                    x-on:click="show = false"
                    class="mt-4 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
                    Fermer
                </button>
            </div>
        </div>

        <!-- Liste des jeux -->
        <div class="mt-6 bg-gray-800 p-6 rounded-lg shadow-lg text-gray-200">
            <h2 class="text-lg font-semibold text-orange-400 mb-4">Liste des jeux</h2>
            <table class="table-auto w-full border-collapse border border-gray-700 rounded-lg">
                <thead>
                    <tr class="bg-gray-700 text-gray-200">
                        <th class="px-4 py-3 border border-gray-600">Nom</th>
                        <th class="px-4 py-3 border border-gray-600">Description</th>
                        <th class="px-4 py-3 border border-gray-600">Nombre de parties totales</th>
                        <th class="px-4 py-3 border border-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->games as $game)
                        <tr class="bg-gray-800">
                            <td class="border px-4 py-2 text-gray-200 border-gray-700">{{ $game->name }}</td>
                            <td class="border px-4 py-2 text-gray-200 border-gray-700">{{ $game->description }}</td>
                            <td class="border px-4 py-2 text-gray-200 border-gray-700">{{ $game->instances->count() }}</td>
                            <td class="border px-4 py-2 border-gray-700">
                                <button 
                                    x-on:click="$dispatch('view_more', { id: '{{ $game->id }}' })"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
                                    Voir +
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $this->games->links() }}
            </div>
        </div>
    </div>
</div>
