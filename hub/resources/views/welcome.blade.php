<x-guest-layout>
    <div class="bg-gray-900 text-white min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-gray-800 p-6 flex justify-between items-center shadow-lg">
            <div>
                <h1 class="text-4xl font-extrabold text-orange-500">Performia</h1>
                <p class="text-gray-400 mt-1">Votre destination ultime pour les jeux en ligne de tous types.</p>
            </div>
            <div class="space-x-4">
                <a class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300"
                    href="{{ route('login') }}">
                    Se connecter
                </a>
                <a class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300"
                    href="{{ route('register') }}">
                    S'enregistrer
                </a>
            </div>
        </header>

        <!-- Main Content -->
        <section class="flex-grow p-8 space-y-6">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:bg-gray-700 transition duration-300">
                <h2 class="text-2xl font-semibold text-blue-300">Explorez nos jeux</h2>
                <p class="mt-2 text-gray-300">Découvrez une large sélection de jeux, des classiques aux nouveautés.</p>
            </div>

            <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:bg-gray-700 transition duration-300">
                <h2 class="text-2xl font-semibold text-blue-300">Rejoignez la communauté</h2>
                <p class="mt-2 text-gray-300">Participez à des événements communautaires et rencontrez d'autres joueurs.</p>
            </div>

            <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:bg-gray-700 transition duration-300">
                <h2 class="text-2xl font-semibold text-blue-300">Support en ligne</h2>
                <p class="mt-2 text-gray-300">Bénéficiez de l'aide de notre support dédié à toute heure du jour et de la nuit.</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 p-4 text-center text-gray-400">
            <p>© 2024 Performia Hub. Tous droits réservés.</p>
        </footer>
    </div>
</x-guest-layout>
