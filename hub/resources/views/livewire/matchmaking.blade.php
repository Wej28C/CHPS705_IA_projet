<div x-data="{
        currentStep: 'form'
    }"
    x-on:matchmaking-start.window="currentStep = 'matchmaking'">
    <div class="bg-white p-4 rounded-xl shadow-xl"
        x-show="currentStep === 'form'">
        <h1 class="text-2xl font-bold mb-4">Choisissez un jeu pour commencer</h1>
        <label for="gameSelect" class="block mb-2 text-sm font-medium text-gray-300">Sélectionnez un jeu :</label>
        <select id="gameSelect" class="bg-gray-700 text-white rounded border border-gray-600 p-2 w-full mb-4">
            <option value="">--Sélectionnez un jeu--</option>
            @foreach($this->games as $game)
                <option wire:model="matchmakingState.gameName" value="{{ $game->name }}">{{ $game->name }}</option>
            @endforeach
        </select>
        <button wire:click="submitMatchmakingForm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
            Lancer la partie
        </button>
    </div>
    <div class="bg-white p-4 rounded-xl shadow-xl"
        x-show="currentStep === 'matchmaking'"
        x-cloak>
        <h1 class="text-2xl font-bold mb-4">Matchmaking en cours</h1>
    </div>
</div>