
<div x-data="{
        currentStep: 'form'
    }"
    x-on:matchmaking-start.window="
        currentStep = 'matchmaking';
        console.log($event);
    "
    x-cloak>
    
    <div class="bg-gray-800 p-6 rounded-xl shadow-2xl transition duration-500 ease-in-out transform"
        x-show="currentStep === 'form'">
        <h1 class="text-3xl font-extrabold text-orange-500 mb-6">Choisissez un jeu pour commencer</h1>
        
        <label for="gameSelect" class="block mb-3 text-sm font-semibold text-blue-200">Sélectionnez un jeu :</label>
        <select id="gameSelect" class="bg-gray-700 text-blue-100 rounded-lg border border-blue-500 focus:ring-orange-400 focus:border-orange-500 p-3 w-full mb-6 transition duration-300 ease-in-out" wire:model="matchmakingState.gameName" >
            <option value="">--Sélectionnez un jeu--</option>
            @foreach($this->games as $game)
                <option value="{{ $game->name }}">{{ $game->name }}</option>
            @endforeach
        </select>
        
        <button wire:click="submitMatchmakingForm" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-lg w-full transition duration-300 ease-in-out transform hover:scale-105">
            Lancer la partie
        </button>
    </div>
    
    <div class="bg-gray-800 p-6 rounded-xl shadow-2xl transition duration-500 ease-in-out transform"
        x-show="currentStep === 'matchmaking'">
        <h1 class="text-3xl font-extrabold text-orange-500 mb-6">Matchmaking en cours</h1>
        <div class="w-full flex justify-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-orange-600"></div>
        </div>
    </div>
</div>
