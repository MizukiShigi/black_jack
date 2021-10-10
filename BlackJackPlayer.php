<?php
namespace BlackJack;
// use BlackJack\PlayerInterface;

require_once('BlackJackPlayerInterface.php');
require_once('BlackJackHandEvaluator.php');
require_once('BlackJackHand.php');

class BlackJackPlayer 
{
    // private array $hand = [];
    // private BlackJackHandEvaluator $handEvaluator;
    private BlackJackHand $hand;

    public function __construct(private string $name)
    {
        // $this->handEvaluator = new BlackJackHandEvaluator();
        $this->hand = new BlackJackHand();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function drawCards(BlackJackDeck $deck, int $drawNum): array
    {
        $cards = $deck->drawCards($drawNum);
        $this->setHand($cards);
        return $cards;
    }

    public function setHand(array $cards): void
    {
        $this->hand->setHand($cards);
    }

    public function getHand(): BlackJackHand
    {
        return $this->hand;
    }

    // public function getHandScore(): int
    // {
    //     return $this->handEvaluator->getHandScore($this->hand);
    // }

    // public function isHandBurst(): bool
    // {
    //     return $this->handEvaluator->isHandBurst($this->hand);
    // }
}