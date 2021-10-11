<?php
namespace BlackJack;

interface PlayerInterface
{
    public function getName(): string;
    public function drawCard(BlackJackDeck $deck): string;
    public function addHand(BlackJackCard $card): void;
    public function getHand(): array;
    public function getCountHandNumber(): int;
    public function getHandScore(): int;
}