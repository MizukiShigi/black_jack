<?php
namespace BlackJack;

require_once('BlackJackDeck.php');
require_once('BlackJackPlayer.php');
require_once('BlackJackCard.php');
require_once('BlackJackHandEvaluator.php');

class BlackJackGame
{
    private const DEALER_DRAW_STOP = 17;
    private const DRAW = 'Draw';

    public function start(): void
    {
        $deck = new BlackJackDeck();
        $handEvaluator = new BlackJackHandEvaluator();
        $dealer = new BlackJackPlayer('ディーラー');
        $myself = new BlackJackPlayer('あなた');
        $dealerName = $dealer->getName();
        $myselfName = $myself->getName();

        echo 'ブラックジャックを開始します。' . PHP_EOL;

        $myselfFirstCards = $myself->drawCards($deck, 2);
        echo $myselfName . 'の引いたカードは' . $myselfFirstCards[0]->getSuit() . 'の' . $myselfFirstCards[0]->getNumber() . 'です。' . PHP_EOL;
        echo $myselfName . 'の引いたカードは' . $myselfFirstCards[1]->getSuit() . 'の' . $myselfFirstCards[1]->getNumber() . 'です。' . PHP_EOL;

        $dealerFirstCards = $dealer->drawCards($deck, 2);
        echo $dealerName . 'の引いたカードは' . $dealerFirstCards[0]->getSuit() . 'の' . $dealerFirstCards[0]->getNumber() . 'です。' . PHP_EOL;
        echo $dealerName . 'の引いた2枚目のカードはわかりません。' . PHP_EOL;

        while (true) {
            echo $myselfName . 'の現在の得点は' . $handEvaluator->getHandScore($myself->getHand()) . 'です。カードを引きますか？(Y/N)' . PHP_EOL;
            if (trim(fgets(STDIN)) === 'Y') {
                $myselfDrawCard = $myself->drawCards($deck, 1);
                echo $myselfName . 'の引いたカードは' . $myselfDrawCard[0]->getSuit() . 'の' . $myselfDrawCard[0]->getNumber() . 'です。' . PHP_EOL;
                if ($handEvaluator->isHandBurst($myself->getHand())) {
                    break;
                }
            } else {
                break;
            }
        }

        echo $dealerName . 'の引いた2枚目のカードは' . $dealerFirstCards[1]->getSuit() . 'の' . $dealerFirstCards[1]->getNumber() . 'でした。' . PHP_EOL;
        echo $dealerName . 'の現在の得点は' . $handEvaluator->getHandScore($dealer->getHand()) . 'です。' . PHP_EOL;
        
        while (true) {
            $dealerDrawCard = $dealer->drawCards($deck, 1);
            echo $dealerName . 'の引いたカードは' . $dealerDrawCard[0]->getSuit() . 'の' . $dealerDrawCard[0]->getNumber() . 'です。' . PHP_EOL;
            if ($handEvaluator->getHandScore($dealer->getHand()) < self::DEALER_DRAW_STOP) {
                echo $dealerName . 'の現在の得点は' . $handEvaluator->getHandScore($dealer->getHand()) . 'です。' . PHP_EOL;
            } else {
                break; 
            }
        }

        echo $myselfName . 'の得点は' . $handEvaluator->getHandScore($myself->getHand()) . 'です。' . PHP_EOL;
        echo $dealerName . 'の得点は' . $handEvaluator->getHandScore($dealer->getHand()) . 'です。' . PHP_EOL;

        $winner = $handEvaluator->getWinner($dealer, $myself);
        if ($winner === self::DRAW) {
            echo '引き分けです。' . PHP_EOL;
        } else {
            echo $winner . 'の勝ちです。' . PHP_EOL;
        }
        echo 'ブラックジャックを終了します。' . PHP_EOL;
        exit();
    }
}