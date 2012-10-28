<?php

namespace KataTennis\Lib;

class TennisGame
{
    const
        PLAYER_A = "A",
        PLAYER_B = "B",
        NO_WINNER = "";

    protected
        $pointsPlayerA,
        $pointsPlayerB;

    public function __construct()
    {
        $this->pointsPlayerA = 0;
        $this->pointsPlayerB = 0;
    }

    public function getScorePlayerA()
    {
        return $this->getScore($this->pointsPlayerA, $this->pointsPlayerB);
    }

    public function getScorePlayerB()
    {
        return $this->getScore($this->pointsPlayerB, $this->pointsPlayerA);
    }

    public function addPointPlayerA()
    {
        $this->pointsPlayerA++;
    }

    public function addPointPlayerB()
    {
        $this->pointsPlayerB++;
    }

    protected function getScore($points = 0, $rivalPoints = 0)
    {
        if ($this->isAdvantage()) {
            return sprintf("40%s", ($points > $rivalPoints) ? "+" : "");
        }
        $scores = array(
            0 => "0", 1 => "15", 2 => "30", 3 => "40"
        );
        return $scores[$points];
    }

    public function getWinner()
    {
        if ($this->isAdvantage()) {
            return $this->getWinnerForGameInAdvantage();
        }
        return $this->getWinnerForNormalGame();
    }

    protected function getWinnerForGameInAdvantage()
    {
        if ($this->isDifferenceToWinInAdvantage()) {
            return ($this->pointsPlayerA > $this->pointsPlayerB) ? self::PLAYER_A : self::PLAYER_B;
        }
        return self::NO_WINNER;
    }

    protected function getWinnerForNormalGame()
    {
        if ($this->pointsPlayerA > 3) {
            return self::PLAYER_A;
        } elseif ($this->pointsPlayerB > 3) {
            return self::PLAYER_B;
        }
        return self::NO_WINNER;
    }

    protected function isAdvantage()
    {
        $totalPoints = $this->pointsPlayerA + $this->pointsPlayerB;
        return ($totalPoints >= 7) ? true : false;
    }

    protected function isDifferenceToWinInAdvantage()
    {
        $difference = abs($this->pointsPlayerA - $this->pointsPlayerB);
        return ($difference >= 2) ? true : false;
    }



}