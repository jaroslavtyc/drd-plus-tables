<?php
namespace DrdPlus\Tests\Tables\Measurements\Amount;

use DrdPlus\Tables\Measurements\Amount\Amount;
use DrdPlus\Tables\Measurements\Amount\AmountBonus;
use DrdPlus\Tables\Measurements\Amount\AmountTable;
use Granam\Tests\Tools\TestWithMockery;

class AmountTableTest extends TestWithMockery
{

    /**
     * @test
     */
    public function I_can_get_headers()
    {
        $amountTable = new AmountTable();
        self::assertEquals([['bonus', 'amount']], $amountTable->getHeader());
    }

    /**
     * @test
     */
    public function I_can_convert_bonus_to_amount()
    {
        $amountTable = new AmountTable();
        $maxAttempts = 10000;
        $attempt = 1;
        do {
            $zeroOrOne = $amountTable->toAmount(new AmountBonus(-20, $amountTable));
            if ($zeroOrOne->getValue() === 1.0) {
                break;
            }
        } while ($attempt++ < $maxAttempts);
        self::assertLessThan($maxAttempts, $attempt);
        self::assertSame(1.0, $zeroOrOne->getValue());
        self::assertSame(
            1.0,
            $amountTable->toAmount(new AmountBonus(0, $amountTable))->getValue()
        );
        self::assertSame(
            90000.0,
            $amountTable->toAmount(new AmountBonus(99, $amountTable))->getValue()
        );
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function too_low_bonus_to_amount_cause_exception()
    {
        $amountTable = new AmountTable();
        $amountTable->toAmount(new AmountBonus(-21, $amountTable));
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function too_high_bonus_to_amount_cause_exception()
    {
        $amountTable = new AmountTable();
        $amountTable->toAmount(new AmountBonus(100, $amountTable));
    }

    /**
     * @test
     */
    public function can_convert_amount_to_bonus()
    {
        $amountTable = new AmountTable();
        self::assertSame(
            0,
            $amountTable->toBonus(new Amount(1, Amount::AMOUNT, $amountTable))->getValue()
        );

        self::assertSame(
            40,
            $amountTable->toBonus(new Amount(104, Amount::AMOUNT, $amountTable))->getValue()
        ); // 40 is the closest bonus (lower in this case)
        self::assertSame(
            41,
            $amountTable->toBonus(new Amount(105, Amount::AMOUNT, $amountTable))->getValue()
        ); // 40 and 41 are closest bonuses, 41 is taken because higher
        self::assertSame(
            41,
            $amountTable->toBonus(new Amount(106, Amount::AMOUNT, $amountTable))->getValue()
        ); // 41 is the closest bonus (higher in this case)

        self::assertSame(
            99,
            $amountTable->toBonus(new Amount(90000, Amount::AMOUNT, $amountTable))->getValue()
        );
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function too_low_value_to_bonus_cause_exception()
    {
        $amountTable = new AmountTable();
        $amountTable->toBonus(new Amount(0, Amount::AMOUNT, $amountTable));
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function too_high_value_to_bonus_cause_exception()
    {
        $amountTable = new AmountTable();
        $amountTable->toBonus(new Amount(90001, Amount::AMOUNT, $amountTable));
    }
}
