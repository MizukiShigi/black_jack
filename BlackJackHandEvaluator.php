<?php
namespace BlackJack;

class BlackJackHandEvaluator
{
    private const BLACK_JACK = 21;
    private const HAND_BURST = 22;
    private const MAX_A_RANK = 11;
    private const MIN_A_RANK = 1;
    private const DRAW = 'Draw';

    public function getHandScore(BlackJackHand $hand): int
    {
        $handScore = 0;
        $countA = 0;
        foreach ($hand->getHand() as $card) {
            if ($card->getNumber() === 'A') {
                $countA ++;
            } else {
                $handScore += $card->getRank();
            }
        }
        for ($i=0; $i<$countA; $i++) {
            if ($handScore + self::MAX_A_RANK < self::HAND_BURST) {
                $handScore += self::MAX_A_RANK;
            } else {
                $handScore += self::MIN_A_RANK;
            }
        }
        return $handScore;
    }

    public function getWinner(BlackJackPlayer $dealer, BlackJackPlayer $player): string
    {
        $dealerHand = $dealer->getHand();
        $playerHand = $player->getHand();
        $dealerName = $dealer->getName();
        $playerName = $player->getName();
        
        if ($this->isHandBurst($dealerHand) && $this->isHandBurst($playerHand)) {
            return $dealerName;
        } elseif ($this->isHandBurst($playerHand)) {
            return $dealerName;
        } elseif ($this->isHandBurst($dealerHand)) {
            return $playerName;
        } elseif ($this->getHandScore($dealerHand) > $this->getHandScore($playerHand)) {
            return $dealerName;
        } elseif ($this->getHandScore($playerHand) > $this->getHandScore($dealerHand)) {
            return $playerName;
        } else {
            if ($this->isBlackJack($dealerHand) && $this->isBlackJack($playerHand)) {
                return self::DRAW;
            } elseif ($this->isBlackJack($dealerHand)) {
                return $dealerName;
            } elseif ($this->isBlackJack($playerHand)) {
                return $playerName;
            } else {
                return self::DRAW;
            }
        }
    }

    public function isHandBurst(BlackJackHand $hand): bool
    {
        return $this->getHandScore($hand) >= self::HAND_BURST;
    }

    private function isBlackJack(BlackJackHand $hand): bool
    {
        return $this->getHandScore($hand) === self::BLACK_JACK && count($hand->getHand()) === 2;
    }
}