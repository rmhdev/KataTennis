<?php

use KataTennis\Lib\TennisGame;

class TennisGameTest extends \PHPUnit_Framework_TestCase
{

    public function testInitialTennisGameStatus()
    {
        $tennisGame = $this->generateTennisGame(0, 0);

        $this->assertEquals(TennisGame::NO_WINNER, $tennisGame->getWinner());
    }

    public function testAddOnePointScoreToPlayerA()
    {
        $tennisGame = $this->generateTennisGame(1, 0);

        $this->assertEquals("15", $tennisGame->getScorePlayerA());
        $this->assertEquals("0", $tennisGame->getScorePlayerB());
        $this->assertEquals(TennisGame::NO_WINNER, $tennisGame->getWinner());
    }

    public function testAddOnePointScoreToBothPlayers()
    {
        $tennisGame = $this->generateTennisGame(1, 1);

        $this->assertEquals("15", $tennisGame->getScorePlayerA());
        $this->assertEquals("15", $tennisGame->getScorePlayerB());
        $this->assertEquals(TennisGame::NO_WINNER, $tennisGame->getWinner());
    }

    public function testAddTwoPointsScoreToPlayerA()
    {
        $tennisGame = $this->generateTennisGame(2, 0);

        $this->assertEquals("30", $tennisGame->getScorePlayerA());
        $this->assertEquals("0", $tennisGame->getScorePlayerB());
        $this->assertEquals(TennisGame::NO_WINNER, $tennisGame->getWinner());
    }

    public function testAddThreePointsScoreToPlayerB()
    {
        $tennisGame = $this->generateTennisGame(0, 3);

        $this->assertEquals("40", $tennisGame->getScorePlayerB());
        $this->assertEquals("0", $tennisGame->getScorePlayerA());
        $this->assertEquals(TennisGame::NO_WINNER, $tennisGame->getWinner());
    }

    public function testPlayerAWins()
    {
        $tennisGame = $this->generateTennisGame(4, 0);

        $this->assertEquals(TennisGame::PLAYER_A, $tennisGame->getWinner());
    }


    public function testPlayerBWins()
    {
        $tennisGame = $this->generateTennisGame(0, 4);

        $this->assertEquals(TennisGame::PLAYER_B, $tennisGame->getWinner());
    }

    public function testPlayersAreInDeuce()
    {
        $tennisGame = $this->generateTennisGame(3, 3);

        $this->assertEquals(TennisGame::NO_WINNER, $tennisGame->getWinner());
    }

    public function testPlayerAHasAdvantage()
    {
        $tennisGame = $this->generateTennisGame(4, 3);

        $this->assertEquals(TennisGame::NO_WINNER, $tennisGame->getWinner());
        $this->assertEquals("40+", $tennisGame->getScorePlayerA());
        $this->assertEquals("40", $tennisGame->getScorePlayerB());
    }

    public function testPlayerBHasAdvantage()
    {
        $tennisGame = $this->generateTennisGame(4, 5);

        $this->assertEquals("40", $tennisGame->getScorePlayerA());
        $this->assertEquals("40+", $tennisGame->getScorePlayerB());
        $this->assertEquals(TennisGame::NO_WINNER, $tennisGame->getWinner());
    }

    public function testPlayerAWinsAfterAdvantage()
    {
        $tennisGame = $this->generateTennisGame(7, 5);

        $this->assertEquals(TennisGame::PLAYER_A, $tennisGame->getWinner());
    }

    public function testPlayerBWinsAfterAdvantage()
    {
        $tennisGame = $this->generateTennisGame(10, 12);

        $this->assertEquals(TennisGame::PLAYER_B, $tennisGame->getWinner());
    }


    protected function generateTennisGame($pointsPlayerA = 0, $pointsPlayerB = 0)
    {
        $tennisGame = new TennisGame();
        for ($i = 0; $i < $pointsPlayerA; $i++) {
            $tennisGame->addPointPlayerA();
        }
        for ($i = 0; $i < $pointsPlayerB; $i++) {
            $tennisGame->addPointPlayerB();
        }

        return $tennisGame;
    }

}
