<?php
namespace BlackJack;

use BlackJack\PlayerInterface;
use BlackJack\Deck;

class Dealer implements PlayerInterface
{
    private array $hand;
    public function drawCards(Deck $deck, int $drawNum): array
    {
        return $deck->drawCards($drawNum);
    }

    public function setHand(array $card): void
    {
        $this->hand[] = $card;
    }

    public function getHand(): array
    {
        return $this->hand;
    }
}