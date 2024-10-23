<div class="flex flex-col items-center bg-gray-900 ">
    <!-- Informations du jeu et serveur -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-orange-500">{{ $gameName }}</h1>
        <p class="text-gray-300 mt-2">Connecté au serveur : <span class="text-blue-300">{{ $ip }}:{{ $port }}</span></p>
    </div>

    <!-- Zone de jeu (canvas) -->
    <div class="w-full max-w-4xl bg-gray-800 shadow-lg rounded-lg p-4">
        <canvas id="gameCanvas" class="block w-full h-auto" style="aspect-ratio: 16 / 9; background-color: #040627;"></canvas>
    </div>
</div>

<script>
    const canvas = document.getElementById('gameCanvas');
    const ctx = canvas.getContext('2d');
    let canvasWidth = canvas.clientWidth;
    let canvasHeight = canvas.clientWidth * 9 / 16;
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;

    // Variables du jeu
    let choixJoueur = null;
    let choixAdversaire = null;
    let resultat = null;
    let isWaitingForResult = false;

    // Dessiner le jeu
    function drawGame() 
    {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Dessiner les options
        const optionWidth = canvas.width / 3;

        // Pierre
        drawOption(0, 0, optionWidth, canvas.height, 'PIERRE');
        // Feuille
        drawOption(optionWidth, 0, optionWidth, canvas.height, 'FEUILLE');
        // Ciseaux
        drawOption(optionWidth * 2, 0, optionWidth, canvas.height, 'CISEAUX');

        // Afficher le résultat si disponible
        if (resultat) {
            ctx.fillStyle = 'white';
            ctx.font = '30px Arial';
            ctx.textAlign = 'center';
            ctx.fillText(resultat, canvas.width / 2, canvas.height - 50);
        }
    }

    function drawOption(x, y, width, height, type) 
    {
        // Fond de l'option
        ctx.fillStyle = '#1f2937'; // Couleur de fond des options
        ctx.fillRect(x, y, width, height);

        // Dessiner le symbole correspondant
        if (type === 'PIERRE') {
            drawRock(x + width / 2, y + height / 2, Math.min(width, height) / 4);
        } else if (type === 'FEUILLE') {
            drawPaper(x + width / 2, y + height / 2, width / 2, height / 2);
        } else if (type === 'CISEAUX') {
            drawScissors(x + width / 2, y + height / 2, Math.min(width, height) / 4);
        }
    }

    function drawRock(centerX, centerY, radius) 
    {
        ctx.fillStyle = 'gray';
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
        ctx.fill();
    }

    function drawPaper(centerX, centerY, width, height) 
    {
        ctx.fillStyle = 'white';
        ctx.fillRect(centerX - width / 2, centerY - height / 2, width, height);
    }

    function drawScissors(centerX, centerY, size) 
    {
        ctx.strokeStyle = 'silver';
        ctx.lineWidth = 5;

        // Lame gauche
        ctx.beginPath();
        ctx.moveTo(centerX, centerY);
        ctx.lineTo(centerX - size, centerY - size);
        ctx.stroke();

        // Lame droite
        ctx.beginPath();
        ctx.moveTo(centerX, centerY);
        ctx.lineTo(centerX + size, centerY - size);
        ctx.stroke();

        // Anneaux
        ctx.beginPath();
        ctx.arc(centerX - size / 2, centerY + size / 2, size / 4, 0, Math.PI * 2);
        ctx.stroke();

        ctx.beginPath();
        ctx.arc(centerX + size / 2, centerY + size / 2, size / 4, 0, Math.PI * 2);
        ctx.stroke();
    }

    // Mettre à jour la taille du canvas lors du redimensionnement de la fenêtre
    window.addEventListener('resize', () => 
    {
        canvasWidth = canvas.clientWidth;
        canvasHeight = canvas.clientWidth * 9 / 16;
        canvas.width = canvasWidth;
        canvas.height = canvasHeight;
        drawGame();
    });

    // Gérer les clics sur le canvas
    canvas.addEventListener('click', function(event) 
    {
        if (isWaitingForResult) return; // Empêcher de faire un choix avant d'avoir le résultat

        const rect = canvas.getBoundingClientRect();
        const x = event.clientX - rect.left;

        const optionWidth = canvas.width / 3;
        let choix = null;

        if (x < optionWidth) {
            choix = 'PIERRE';
        } else if (x < optionWidth * 2) {
            choix = 'FEUILLE';
        } else {
            choix = 'CISEAUX';
        }

        envoyerChoix(choix);
    });

    // Établir la connexion WebSocket
    const ws = new WebSocket('ws://{{ $ip }}:{{ $port }}');

    ws.onopen = function () 
    {
        console.log('Connecté au serveur WebSocket');
    };

    ws.onmessage = function (event) 
    {
        console.log('Message du serveur :', event.data);
        handleServerMessage(event.data);
    };

    ws.onclose = function () 
    {
        console.log('Déconnecté du serveur WebSocket');
    };

    ws.onerror = function (error) 
    {
        console.error('Erreur WebSocket :', error);
    };

    function envoyerChoix(choix) 
    {
        choixJoueur = choix;
        isWaitingForResult = true;
        const message = JSON.stringify({ action: 'jouer', choix: choix });
        ws.send(message);
        resultat = 'En attente de l\'adversaire...';
        drawGame();
    }

    function handleServerMessage(message) 
    {
        const data = JSON.parse(message);

        if (data.type === 'resultat') 
        {
            choixAdversaire = data.choixAdversaire;
            afficherResultat(data.resultat, choixJoueur, choixAdversaire);
            isWaitingForResult = false;
        } 
        else if (data.type === 'erreur') 
        {
            resultat = data.message;
            isWaitingForResult = false;
            drawGame();
        }
    }

    function afficherResultat(res, votreChoix, choixAdv) 
    {
        if (res === 'gagne') 
        {
            resultat = `Vous avez gagné ! Vous: ${votreChoix}, Adversaire: ${choixAdv}`;
        } 
        else if (res === 'perdu') 
        {
            resultat = `Vous avez perdu... Vous: ${votreChoix}, Adversaire: ${choixAdv}`;
        } 
        else 
        {
            resultat = `Match nul. Vous avez tous les deux choisi ${votreChoix}.`;
        }
        drawGame();
    }

    // Dessiner le jeu initialement
    drawGame();
</script>
