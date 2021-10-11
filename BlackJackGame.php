<?php
namespace BlackJack;

require_once('BlackJackDeck.php');
require_once('BlackJackPlayer.php');
require_once('BlackJackDealer.php');
require_once('BlackJackCard.php');
require_once('BlackJackHandEvaluator.php');

class BlackJackGame
{
    private const DEALER_DRAW_STOP = 17;
    private const CPU_DRAW_STOP = 18;
    private const DRAW = 'Draw';
    private BlackJackHandEvaluator $handEvaluator;
    private BlackJackDeck $deck;

    public function __construct(private PlayerInterface $dealer, private PlayerInterface $player, private AdditionalPlayer $additionalPlayerNumber)
    {
        $this->handEvaluator = new BlackJackHandEvaluator();
        $this->deck = new BlackJackDeck();
    }

    public function start(): void
    {
        $cpuPlayers = $this->createCpuPlayer($this->additionalPlayerNumber->getAddPlayerNumber());

        echo 'ブラックジャックを開始します。' . PHP_EOL;

        $this->init($this->player);
        foreach ($cpuPlayers as $cpu) {
            $this->init($cpu);
        }
        $this->init($this->dealer);
        
        $this->playerTurn();
        foreach ($cpuPlayers as $cpu) {
            $this->cpuPlayerTurn($cpu);
        }
        $this->dealerTurn();
        
        $this->matchPlayerVsDealer($this->player, $this->dealer);
        foreach ($cpuPlayers as $cpu) {
            $this->matchPlayerVsDealer($cpu, $this->dealer);
        }
        
        echo 'ブラックジャックを終了します。' . PHP_EOL;
    }

    private function init(PlayerInterFace $player): void
    {
        for ($i=0; $i<2; $i++) {
            $initDrawCard = $player->drawCard($this->deck);
            echo $initDrawCard;
        }
    }

    private function playerTurn(): void
    {
        $playerName = $this->player->getName();
        while (true) {
            echo $playerName . 'の現在の得点は' . $this->player->getHandScore() . 'です。カードを引きますか？(Y/N)' . PHP_EOL;
            $answer = trim(fgets(STDIN));
            if ($answer === 'Y') {
                $playerDrawCard = $this->player->drawCard($this->deck);
                echo $playerDrawCard;
                if ($this->player->getHandScore() > 21) {
                    break;
                }
            } elseif ($answer === 'N') {
                break;
            } else {
                echo ' Y か N を選択して入力してください。' . PHP_EOL;
            }
        }
    }

    private function cpuPlayerTurn(PlayerInterface $cpu): void
    {
        $cpuPlayerName = $cpu->getName();
        while (true) {
            echo $cpuPlayerName . 'の現在の得点は' . $cpu->getHandScore() . 'です。' . PHP_EOL;
            if ($cpu->getHandScore() < self::CPU_DRAW_STOP) {
                $playerDrawCard = $cpu->drawCard($this->deck);
                echo $playerDrawCard;
                if ($cpu->getHandScore() > 21) {
                    break;
                }
            } else {
                break;
            }
        }
    }

    private function dealerTurn(): void
    {
        $dealerName = $this->dealer->getName();
        $dealerBackCard = $this->dealer->getHand()[1];
        echo $dealerName . 'の引いた2枚目のカードは' . $dealerBackCard->getSuit() . 'の' . $dealerBackCard->getNumber() . 'でした。' . PHP_EOL;
        echo $dealerName . 'の現在の得点は' . $this->dealer->getHandScore() . 'です。' . PHP_EOL;
        
        while (true) {
            if ($this->dealer->getHandScore() < self::DEALER_DRAW_STOP) {
                $dealerDrawCard = $this->dealer->drawCard($this->deck);
                echo $dealerDrawCard;
                echo $dealerName . 'の現在の得点は' . $this->dealer->getHandScore() . 'です。' . PHP_EOL;
            } else {
                break; 
            }
        }
    }

    private function matchPlayerVsDealer(PlayerInterface $player, PlayerInterface $dealer): void
    {
        $playerName = $player->getName();
        $dealerName = $dealer->getName();
        echo $playerName . 'の得点は' . $player->getHandScore() . 'です。' . PHP_EOL;
        echo $dealerName . 'の得点は' . $dealer->getHandScore() . 'です。' . PHP_EOL;
        echo $playerName . 'VS' . $dealerName . PHP_EOL;
        $winner = $this->handEvaluator->getWinner($dealer, $player);
        if ($winner === self::DRAW) {
            echo '引き分けです。' . PHP_EOL;
        } else {
            echo $winner . 'の勝ちです。' . PHP_EOL;
        }
        echo '' . PHP_EOL;
    }

    private function createCpuPlayer(int $cpuPlayerNumber): array
    {
        $cpuPlayers = [];
        for ($i = 1; $i < $cpuPlayerNumber + 1; $i++) {
            $cpuPlayers[] = new BlackJackPlayer('cpu' . $i);
        }
        return $cpuPlayers;
    }
}