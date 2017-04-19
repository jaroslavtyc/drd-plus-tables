<?php
namespace DrdPlus\Tests\Tables\Measurements\Time;

use DrdPlus\Codes\TimeCode;
use DrdPlus\Tables\Measurements\Time\TimeBonus;
use DrdPlus\Tables\Measurements\Time\TimeTable;
use DrdPlus\Tests\Tables\Measurements\AbstractTestOfBonus;

class TimeBonusTest extends AbstractTestOfBonus
{
    /**
     * @test
     * @expectedException \DrdPlus\Tables\Measurements\Time\Exceptions\CanNotConvertThatBonusToTime
     */
    public function I_can_not_get_time_in_unsupported_bonus_to_unit_conversion()
    {
        $timeBonus = new TimeBonus(0, new TimeTable());
        try {
            self::assertNull($timeBonus->findTime(TimeCode::YEAR));
        } catch (\Exception $exception) {
            self::fail('No exception should happen so far ' . $exception->getTraceAsString());
        }
        $timeBonus->getTime(TimeCode::YEAR);
    }
}