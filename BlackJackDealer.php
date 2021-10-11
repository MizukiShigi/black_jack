<?php
namespace BlackJack;

require_once('BlackJackHandEvaluator.php');
require_once('BlackJackHand.php');
require_once('Player.php');

class BlackJackDealer extends Player
{
    public function __construct(private string $name)
    {
        parent::__construct($name);
    }

    public function drawCard(BlackJackDeck $deck): string
    {
        $card = $deck->drawCard();
        $this->addHand($card);
        if ($this->getCountHandNumber() === 2) {
            return $this->name . 'の引いた2枚目のカードはわかりません。' . PHP_EOL;
        }
        return $this->name . 'の引いたカードは' . $card->getSuit() . 'の' . $card->getNumber() . 'です' . PHP_EOL;
    }
}