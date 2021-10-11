<?php
namespace BlackJack;

// require_once('BlackJackCard.php');

class BlackJackDeck
{
    private const SUIT = ['ハート', 'ダイヤ', 'クローバー', 'スペード'];
    private const NUMBER = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
    private array $deck;
    public function __construct()
    {
        foreach (self::SUIT as $suit) {
            foreach (self::NUMBER as $number) {
                $this->deck[] = new BlackJackCard($suit, $number);
            }
        }
        shuffle($this->deck);
    }
    public function drawCard(): BlackJackCard
    {
        $drawCard = array_splice($this->deck, 0, 1)[0];
        return $drawCard;
    }
}