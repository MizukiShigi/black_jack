<?php
namespace BlackJack;

use Exception;

class AdditionalPlayer
{
    private int $additionalPlayerNumber;
    private const ADD_PLAYER_NUMBER = [0, 1, 2];
    
    public function __construct(int $additionalPlayerNumber)
    {
        if (in_array($additionalPlayerNumber, self::ADD_PLAYER_NUMBER)) {
            $this->additionalPlayerNumber = $additionalPlayerNumber;
        } else {
            try {
                throw new Exception('Args Error : 引数additionalPlayerNumberは' . implode(',', self::ADD_PLAYER_NUMBER) . 'のどれかを与えてください');
            } catch (Exception $e){
                echo $e->getMessage();
            }
        }
    }

    public function getAddPlayerNumber(): int
    {
        return $this->additionalPlayerNumber;
    }


}