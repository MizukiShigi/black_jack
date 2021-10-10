<?php
namespace BlackJack;
// use BlackJack\PlayerInterface;

require_once('BlackJackPlayerInterface.php');
require_once('BlackJackHandEvaluator.php');

class BlackJackPlayer implements BlackJackPlayerInterface
{
    private array $hand = [];
    private BlackJackHandEvaluator $handEvaluator;
    public function __construct(private string $name)
    {
        $this->handEvaluator = new BlackJackHandEvaluator();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function drawCards(BlackJackDeck $deck, int $drawNum): array
    {
        return $deck->drawCards($drawNum);
    }

    public function setHand(array $cards): void
    {
        $this->hand = array_merge($this->hand, $cards);
    }

    public function getHand(): array
    {
        return $this->hand;
    }

    public function getHandScore(): int
    {
        return $this->handEvaluator->getHandScore($this->hand);
    }

    public function isHandBurst(): bool
    {
        return $this->handEvaluator->isHandBurst($this->hand);
    }
}