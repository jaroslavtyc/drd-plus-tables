<?php
namespace DrdPlus\Tables\Time;

use DrdPlus\Tables\Parts\AbstractFileTable;
use DrdPlus\Tables\Tools\DummyEvaluator;

/**
 * @method TimeBonus toBonus(Time $time)
 */
class TimeTable extends AbstractFileTable
{
    public function __construct()
    {
        parent::__construct(new DummyEvaluator());
    }

    protected function getDataFileName()
    {
        return __DIR__ . '/data/time.csv';
    }

    protected function getExpectedDataHeader()
    {
        return [Time::ROUND, Time::MINUTE, Time::HOUR, Time::DAY, Time::MONTH, Time::YEAR];
    }

    /**
     * @param TimeBonus $timeBonus
     * @param string|null $wantedUnit
     *
     * @return Time
     */
    public function toTime(TimeBonus $timeBonus, $wantedUnit = null)
    {
        return $this->toMeasurement($timeBonus, $wantedUnit);
    }

    /**
     * @param float $value
     * @param string $unit
     *
     * @return Time
     */
    protected function convertToMeasurement($value, $unit)
    {
        return new Time($value, $unit, $this);
    }

    /**
     * @param int $bonusValue
     *
     * @return TimeBonus
     */
    protected function createBonus($bonusValue)
    {
        return new TimeBonus($bonusValue, $this);
    }

}