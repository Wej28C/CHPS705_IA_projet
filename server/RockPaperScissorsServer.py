from websocket_server import WebsocketServer
import json
from RockPaperScissors import RockPaperScissors
from RockPaperScissors import RockPaperScissorsChoice

clients = []
waiting_clients = []
games = {}

# Fonction appelée lorsqu'un nouveau client se connecte
def new_client(client, server):
    print(f"Nouveau client connecté : {client['id']}")
    clients.append(client)

    if waiting_clients:
        opponent = waiting_clients.pop(0)
        # Création d'un nouveau jeu
        game = RockPaperScissors()
        # Attribution des rôles
        games[client['id']] = {'opponent': opponent, 'game': game, 'role': 'playerB'}
        games[opponent['id']] = {'opponent': client, 'game': game, 'role': 'playerA'}

        # Notification aux deux clients
        server.send_message(client, json.dumps({'type': 'info', 'message': 'Un adversaire a été trouvé !'}))
        server.send_message(opponent, json.dumps({'type': 'info', 'message': 'Un adversaire a été trouvé !'}))
    else:
        # Aucun adversaire disponible, le client est mis en attente
        waiting_clients.append(client)
        server.send_message(client, json.dumps({'type': 'info', 'message': 'En attente d\'un adversaire...'}))

# Fonction appelée lorsqu'un message est reçu d'un client
def message_received(client, server, message):
    print(f"Client({client['id']}) a dit : {message}")
    try:
        data = json.loads(message)
        action = data.get('action')
        if action == 'jouer':
            choix = data.get('choix')
            handle_play(client, choix, server)
        else:
            server.send_message(client, json.dumps({'type': 'erreur', 'message': 'Action inconnue.'}))
    except json.JSONDecodeError:
        server.send_message(client, json.dumps({'type': 'erreur', 'message': 'Message mal formaté.'}))

# Gestion du choix du joueur
def handle_play(client, choix, server):
    if client['id'] not in games:
        # Aucun jeu trouvé pour ce client
        server.send_message(client, json.dumps({'type': 'erreur', 'message': 'Aucun adversaire trouvé.'}))
        return

    game_info = games[client['id']]
    game = game_info['game']
    opponent = game_info['opponent']
    role = game_info['role']

    # Conversion du choix en Enum
    try:
        choix_enum = RockPaperScissorsChoice(choix)
    except ValueError:
        server.send_message(client, json.dumps({'type': 'erreur', 'message': 'Choix invalide.'}))
        return

    # Enregistrement du choix du joueur
    if role == 'playerA':
        game.play_a(choix_enum)
    else:
        game.play_b(choix_enum)

    # Vérification si les deux joueurs ont fait leur choix
    if game.playA is not None and game.playB is not None:
        # Envoi du résultat aux deux joueurs
        opponent_info = games[opponent['id']]
        clientA = client if role == 'playerA' else opponent
        clientB = opponent if role == 'playerA' else client
        send_result(game, clientA, clientB, server)
    else:
        # Attente du choix de l'adversaire
        server.send_message(client, json.dumps({'type': 'info', 'message': 'En attente de l\'adversaire...'}))

# Envoi du résultat du jeu aux deux clients
def send_result(game, clientA, clientB, server):
    result = game.get_result()

    if result == 0:
        # Match nul
        resultA = 'nul'
        resultB = 'nul'
    elif result == 1:
        # Joueur A gagne
        resultA = 'gagne'
        resultB = 'perdu'
    elif result == 2:
        # Joueur B gagne
        resultA = 'perdu'
        resultB = 'gagne'

    messageA = json.dumps({
        'type': 'resultat',
        'resultat': resultA,
        'votreChoix': game.playA.value,
        'choixAdversaire': game.playB.value
    })
    messageB = json.dumps({
        'type': 'resultat',
        'resultat': resultB,
        'votreChoix': game.playB.value,
        'choixAdversaire': game.playA.value
    })

    server.send_message(clientA, messageA)
    server.send_message(clientB, messageB)

    # Réinitialisation du jeu pour une nouvelle partie
    game.playA = None
    game.playB = None

# Fonction appelée lorsqu'un client se déconnecte
def client_left(client, server):
    print(f"Client({client['id']}) déconnecté")
    if client in clients:
        clients.remove(client)

    # Suppression du client de la liste d'attente si nécessaire
    if client in waiting_clients:
        waiting_clients.remove(client)

    # Gestion de la déconnexion en cours de partie
    if client['id'] in games:
        game_info = games.pop(client['id'])
        opponent = game_info['opponent']
        # Notification à l'adversaire
        server.send_message(opponent, json.dumps({'type': 'erreur', 'message': 'L\'adversaire a quitté la partie.'}))
        # Suppression des informations de jeu de l'adversaire
        if opponent['id'] in games:
            games.pop(opponent['id'])

# Configuration du serveur WebSocket
server = WebsocketServer(port=12345, host='127.0.0.1')
server.set_fn_new_client(new_client)
server.set_fn_message_received(message_received)
server.set_fn_client_left(client_left)
server.run_forever()
