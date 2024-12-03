import random
import time
from enum import Enum
import socket
import json

# Enum pour représenter les choix possibles
class Choice(Enum):
    ROCK = "ROCK"
    PAPER = "PAPER"
    SCISSORS = "SCISSORS"


class RockPaperScissorsAI:
    def __init__(self,interpreter_host, interpreter_port):
        # Historique des parties
        self.history = []
        self.interpreter_host = interpreter_host
        self.interpreter_port = interpreter_port

    def make_choice(self):
        """
        IA choisit aléatoirement ROCK, PAPER ou SCISSORS.
        Simule un temps de réflexion de l'IA.
        """
        start_time = time.time()
        choice = random.choice(list(Choice))
        response_time = time.time() - start_time
        return choice, response_time

    def save_result(self, player_choice, ai_choice, response_time_player, response_time_ai, winner):
        """
        Enregistre les résultats d'une partie dans l'historique.
        """
        result = {
            'player_choice': player_choice.name,
            'ai_choice': ai_choice.name,
            'response_time_player': round(response_time_player, 3),
            'response_time_ai': round(response_time_ai, 3),
            'winner': winner
        }

       
        self.history.append(result)

        print(f"Résultat sauvegardé : {result}")
        self.send_to_interpreter(result)

     #def send_to_interpreter(self, data):
      #  """
      # Envoie les données au serveur interpréteur via un socket.
      #  """
      #   try:
            # Créer une connexion socket
      #      with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as sock:
      #          sock.connect((self.interpreter_host, self.interpreter_port))

                # Envoyer les données formatées en JSON
       #              sock.sendall(json.dumps(data).encode('utf-8'))
        #         print(f"Données envoyées à l'interpréteur : {data}")
        #
     #   except Exception as e:
    #        print(f"Erreur lors de l'envoi des données à l'interpréteur : {e}")
   
    def send_to_server(self, data, server, player_client):
        """
        Envoie les résultats à travers WebSocket.
        """
        try:
            # Envoie le résultat au joueur humain via WebSocket
            server.send_message(player_client, json.dumps({'type': 'game_result', 'result': data}))
            print(f"Données envoyées au serveur : {data}")
        except Exception as e:
            print(f"Erreur lors de l'envoi des résultats : {e}")

    def analyze_history(self):
        """
        Analyse l'historique des parties pour extraire des statistiques.
        """
        if not self.history:
            print("Aucun historique à analyser.")
            return

        total_games = len(self.history)
        player_wins = sum(1 for r in self.history if r['winner'] == 'player')
        ai_wins = sum(1 for r in self.history if r['winner'] == 'ai')
        draws = sum(1 for r in self.history if r['winner'] == 'draw')

        print(f"Parties totales : {total_games}")
        print(f"Victoires du joueur : {player_wins} ({(player_wins / total_games) * 100:.2f}%)")
        print(f"Victoires de l'IA : {ai_wins} ({(ai_wins / total_games) * 100:.2f}%)")
        print(f"Égalités : {draws} ({(draws / total_games) * 100:.2f}%)")
    
    def make_choice_for_game(self, opponent_choice=None):
        """
        L'IA prend sa décision en fonction du choix de l'adversaire (si disponible).
        Sinon, elle choisit aléatoirement.
        """
        if opponent_choice:
            # Logique simple de contournement du coup de l'adversaire
            if opponent_choice == Choice.ROCK:
                choice = Choice.PAPER  # Papier bat Rock
            elif opponent_choice == Choice.PAPER:
                choice = Choice.SCISSORS  # Ciseaux bat Papier
            elif opponent_choice == Choice.SCISSORS:
                choice = Choice.ROCK  # Rock bat Ciseaux
        else:
            # Choix aléatoire
            choice = random.choice(list(Choice))

        return choice