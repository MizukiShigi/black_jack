<?php
namespace BlackJack;

class BlackJackHand
{
    private const BLACKJACK_HALF = 11;
    private array $hand = [];

    public function addHand(BlackJackCard $card): void
    {
        $this->hand[] = $card;
    }

    public function getHand(): array
    {
        return $this->hand;
    }

    public function getCountHandNumber(): int
    {
        return count($this->hand);
    }

    public function getHandScore(): int
    {
        $handScore = 0;
        $countA = 0;
        foreach ($this->hand as $card) {
            if ($card->getNumber() === 'A') {
                $countA ++;
            } else {
                $handScore += $card->getRank();
            }
        }
        for ($i=0; $i<$countA; $i++) {
            if ($handScore <= self::BLACKJACK_HALF) {
                $handScore += BlackJackCard::MAX_A_RANK;
            } else {
                $handScore += BlackJackCard::MIN_A_RANK;
            }
        }
        return $handScore;
    }
}