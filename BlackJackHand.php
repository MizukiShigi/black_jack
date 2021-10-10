<?php
namespace BlackJack;

class BlackJackHand
{
    private array $hand = [];

    public function setHand(array $cards): void
    {
        $this->hand = array_merge($this->hand, $cards);
    }

    public function getHand(): array
    {
        return $this->hand;
    }
}