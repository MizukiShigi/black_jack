<?php
namespace BlackJack;

// use BlackJack\Deck;

interface BlackJackPlayerInterface
{
    public function drawCards(BlackJackDeck $deck, int $drawNum): array;
    public function setHand(array $cards): void;
    public function getHand(): BlackJackHand;
    public function getHandScore(): int;
    // public function isHandBurst(): bool;
    
}