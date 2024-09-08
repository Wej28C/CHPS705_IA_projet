<div class="bg-white p-4 rounded-xl shadow-xl">
    <h1 class="text-2xl font-bold mb-4">Choisissez un jeu pour commencer</h1>
    <form>
        <label for="gameSelect" class="block mb-2 text-sm font-medium text-gray-300">Sélectionnez un jeu :</label>
        <select id="gameSelect" class="bg-gray-700 text-white rounded border border-gray-600 p-2 w-full mb-4">
            <option value="">--Sélectionnez un jeu--</option>
            <option value="game1">Jeu 1</option>
            <option value="game2">Jeu 2</option>
            <option value="game3">Jeu 3</option>
            <option value="game4">Jeu 4</option>
        </select>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
            Lancer la partie
        </button>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ws = new WebSocket("ws://127.0.0.1:12345");

            ws.onopen = function() {
                console.log("Connected to the WebSocket server");
                ws.send("Hello, server!");
            };

            ws.onmessage = function(event) {
                console.log("Message from server: ", event.data);
                var log = document.getElementById("log");
                log.innerHTML += event.data + "<br>";
            };

            ws.onclose = function(event) {
                console.log("Disconnected from the WebSocket server");
            };

            ws.onerror = function(error) {
                console.log("WebSocket Error: " + error);
            };
        });
    </script>

</div>
