<x-guest-layout>
    <div class="bg-gray-900 text-white min-h-screen flex flex-col">
        <header class="bg-gray-800 p-4 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Performia</h1>
                <p class="text-gray-400">Votre destination ultime pour les jeux en ligne de tous types.</p>
            </div>
            <div>
                <a class="bg-blue-500 hover:bg-blue-700 hover:cursor-pointer text-white font-bold py-2 px-4 rounded"
                    href="{{ route('login') }}">
                    Se connecter
                </a>
                <a class="bg-blue-500 hover:bg-blue-700 hover:cursor-pointer text-white font-bold py-2 px-4 rounded ml-4"
                    href="{{ route('register') }}">
                    S'enregistrer
                </a>
            </div>
        </header>

        <section class="flex-grow p-4 space-y-4">
            <div class="bg-gray-800 p-4 rounded">
                <h2 class="text-2xl font-semibold">Explorez nos jeux</h2>
                <p>Découvrez une large sélection de jeux, des classiques aux nouveautés.</p>
            </div>

            <div class="bg-gray-800 p-4 rounded">
                <h2 class="text-2xl font-semibold">Rejoignez la communauté</h2>
                <p>Participez à des événements communautaires et rencontrez d'autres joueurs.</p>
            </div>

            <div class="bg-gray-800 p-4 rounded">
                <h2 class="text-2xl font-semibold">Support en ligne</h2>
                <p>Bénéficiez de l'aide de notre support dédié à toute heure du jour et de la nuit.</p>
            </div>
        </section>

        <footer class="bg-gray-800 p-4 text-center">
            <p>© 2024 Performia Hub. Tous droits réservés.</p>
        </footer>
    </div>
</x-guest-layout>
