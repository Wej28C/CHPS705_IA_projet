from enum import Enum

class RockPaperScissorsChoice(Enum):
    ROCK = 1
    PAPER = 2
    SCISSORS = 3

class RockPaperScissors:
    playA = None
    playB = None
    scoreA = 0
    scoreB = 0

    def __init__(self) -> None:
        self.playA = None
        self.playB = None
        self.scoreA = 0
        self.scoreB = 0
        pass

    def is_finished(self):
        if self.scoreA > 2: # joueur A gagne
            return 1
        elif self.scoreB > 2: # joueur B gagne
            return 2
        else: # Pas finis 
            return 0
        
    def is_finished(self, isPlayerA):
        if self.scoreA > 2: # joueur A gagne
            if isPlayerA: return 1
            else: return -1
        elif self.scoreB > 2: # joueur B gagne
            if isPlayerA: return -1
            else: return 2
        else: # Pas finis 
            return 0

    def hasPlayedA(self):
        return self.playA is not None 
    
    def hasPlayedB(self):
        return self.playB is not None 

    def playForA(self, play):
        self.playA = play

    def playForB(self, play):
        self.playB = play

    def getResult(self):
        if(self.playA == None):
            return -1
        if(self.playB == None):
            return -2
        
        if self.playA == self.playB:
            self.scoreA = self.scoreA + 1
            self.scoreB = self.scoreB + 1
            return 0 # Match nul
        elif (self.playA == RockPaperScissorsChoice.ROCK and self.playB == RockPaperScissorsChoice.SCISSORS) \
            or (self.playA == RockPaperScissorsChoice.SCISSORS and self.playB == RockPaperScissorsChoice.PAPER) \
            or (self.playA == RockPaperScissorsChoice.PAPER and self.playB == RockPaperScissorsChoice.ROCK):
            self.scoreA = self.scoreA + 1
            return 1 # Joueur A gagne
        else:
            self.scoreB = self.scoreB + 1
            return 2 # Joeur B gagne 