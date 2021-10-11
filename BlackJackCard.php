<?php
namespace BlackJack;

class BlackJackCard
{
    private const CARD_RANK = [
        '2' => 2, 
        '3' => 3, 
        '4' => 4, 
        '5' => 5, 
        '6' => 6, 
        '7' => 7, 
        '8' => 8, 
        '9' => 9, 
        '10' => 10, 
        'J' => 10, 
        'Q' => 10, 
        'K' => 10, 
    
    ];
    public const MAX_A_RANK = 11;
    public const MIN_A_RANK = 1;

    public function __construct(private string $suit, private string $number)
    {
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getRank(): int
    {
        return self::CARD_RANK[$this->number];
    }
}