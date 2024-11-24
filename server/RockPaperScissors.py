from enum import Enum

class RockPaperScissorsChoice(Enum):
    ROCK = 1
    PAPER = 2
    SCISSORS = 3

class RockPaperScissors:
    playA = None
    playB = None

    def __init__(self) -> None:
        self.playA = None
        self.playB = None
        pass

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
            return 0 # Match nul
        elif (self.playA == RockPaperScissorsChoice.ROCK and self.playB == RockPaperScissorsChoice.SCISSORS) \
            or (self.playA == RockPaperScissorsChoice.SCISSORS and self.playB == RockPaperScissorsChoice.PAPER) \
            or (self.playA == RockPaperScissorsChoice.PAPER and self.playB == RockPaperScissorsChoice.ROCK):
            return 1 # Joueur A gagne
        else:
            return 2 # Joeur B gagne 