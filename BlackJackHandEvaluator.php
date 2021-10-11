<?php
namespace BlackJack;

class BlackJackHandEvaluator
{
    private const BLACK_JACK = 21;
    private const HAND_BURST = 22;
    private const DRAW = 'Draw';

    public function getWinner(PlayerInterface $dealer, PlayerInterface $player): string
    {
        $dealerHandScore = $dealer->getHandScore();
        $playerHandScore = $player->getHandScore();
        $dealerHandNumber = $dealer->getCountHandNumber();
        $playerHandNumber = $player->getCountHandNumber();
        $dealerName = $dealer->getName();
        $playerName = $player->getName();
        
        if ($this->isHandBurst($dealerHandScore) && $this->isHandBurst($playerHandScore)) {
            return $dealerName;
        } elseif ($this->isHandBurst($playerHandScore)) {
            return $dealerName;
        } elseif ($this->isHandBurst($dealerHandScore)) {
            return $playerName;
        } elseif ($dealerHandScore > $playerHandScore) {
            return $dealerName;
        } elseif ($playerHandScore > $dealerHandScore) {
            return $playerName;
        } else {
            if ($this->isBlackJack($dealerHandScore, $dealerHandNumber) && $this->isBlackJack($playerHandScore, $playerHandNumber)) {
                return self::DRAW;
            } elseif ($this->isBlackJack($dealerHandScore, $dealerHandNumber)) {
                return $dealerName;
            } elseif ($this->isBlackJack($playerHandScore, $playerHandNumber)) {
                return $playerName;
            } else {
                return self::DRAW;
            }
        }
    }

    public function isHandBurst(int $handScore): bool
    {
        return $handScore >= self::HAND_BURST;
    }

    private function isBlackJack(int $handScore, int $handNumber): bool
    {
        return $handScore === self::BLACK_JACK && $handNumber === 2;
    }
}