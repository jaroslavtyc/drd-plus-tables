<?php
namespace DrdPlus\Tests\Tables\History;

use DrdPlus\Tables\History\PossessionTable;
use DrdPlus\Tests\Tables\TableTestInterface;
use Granam\Integer\PositiveIntegerObject;
use Granam\Tests\Tools\TestWithMockery;

class PossessionTableTest extends TestWithMockery implements TableTestInterface
{
    /**
     * @test
     */
    public function I_can_get_header()
    {
        self::assertSame([['background_points', 'gold_coins']], (new PossessionTable())->getHeader());
    }

    /**
     * @test
     * @dataProvider provideBackgroundPointsAndExpectedValueOfPossession
     * @param int $backgroundPoints
     * @param int $expectedValueOfPossession
     */
    public function I_can_get_value_of_possession($backgroundPoints, $expectedValueOfPossession)
    {
        self::assertSame(
            $expectedValueOfPossession,
            (new PossessionTable())->getPossessionAsGoldCoins(new PositiveIntegerObject($backgroundPoints))
        );
    }

    public function provideBackgroundPointsAndExpectedValueOfPossession()
    {
        return [
            [0, 1],
            [1, 3],
            [2, 10],
            [3, 30],
            [4, 100],
            [5, 300],
            [6, 1000],
            [7, 3000],
            [8, 10000],
        ];
    }

    /**
     * @test
     * @expectedException \DrdPlus\Tables\History\Exceptions\UnexpectedBackgroundPoints
     * @expectedExceptionMessageRegExp ~9~
     */
    public function I_can_not_get_value_of_possession_for_unsupported_background_points()
    {
        (new PossessionTable())->getPossessionAsGoldCoins(new PositiveIntegerObject(9));
    }
}