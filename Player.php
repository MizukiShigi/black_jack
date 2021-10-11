<?php
namespace BlackJack;

require_once('BlackJackHand.php');

abstract class Player
{
    private BlackJackHand $hand;
    
    abstract public function drawCard(BlackJackDeck $deck): string;

    public function __construct(private string $name)
    {
        $this->hand = new BlackJackHand();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addHand(BlackJackCard $card): void
    {
        $this->hand->addHand($card);
    }

    public function getHand(): array
    {
        return $this->hand->getHand();
    }

    public function getHandScore(): int
    {
        return $this->hand->getHandScore();
    }

    public function getCountHandNumber(): int
    {
        return $this->hand->getCountHandNumber();
    }
}