<?php
namespace BlackJack;

require_once('BlackJackHandEvaluator.php');
require_once('BlackJackHand.php');
require_once('PlayerInterface.php');

class BlackJackPlayer implements PlayerInterface
{
    private BlackJackHand $hand;

    public function __construct(private string $name)
    {
        $this->hand = new BlackJackHand();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function drawCard(BlackJackDeck $deck): string
    {
        $card = $deck->drawCard();
        $this->addHand($card);
        return $this->name . 'の引いたカードは' . $card->getSuit() . 'の' . $card->getNumber() . 'です' . PHP_EOL;
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