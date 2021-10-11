<?php
namespace BlackJack;

require_once('BlackJackHandEvaluator.php');
require_once('BlackJackHand.php');
require_once('Player.php');

class BlackJackPlayer extends Player
{
    public function __construct(private string $name)
    {
        parent::__construct($name);
    }

    public function drawCard(BlackJackDeck $deck): string
    {
        $card = $deck->drawCard();
        $this->addHand($card);
        return $this->name . 'の引いたカードは' . $card->getSuit() . 'の' . $card->getNumber() . 'です' . PHP_EOL;
    }
}