<?php
namespace BlackJack;

require_once('BlackJackGame.php');
require_once('BlackJackDealer.php');
require_once('BlackJackPlayer.php');
require_once('AdditionalPlayer.php');

$dealer = new BlackJackDealer('ディーラー');
$player = new BlackJackPlayer('私');
$addPlayerNumber = new AdditionalPlayer(2);
$game = new BlackJackGame($dealer, $player, $addPlayerNumber);
$game->start();