<?php
namespace DrdPlus\Tables\Wounds;

use Drd\DiceRoll\Templates\Rolls\Roll1d6;
use DrdPlus\Tables\MeasurementWithBonusInterface;
use DrdPlus\Tables\Parts\AbstractFileTable;
use DrdPlus\Tables\Tools\DiceChanceEvaluator;

/**
 * PPH page 165, top
 *
 * @method WoundsBonus toBonus(MeasurementWithBonusInterface $measurement)
 */
class WoundsTable extends AbstractFileTable
{
    public function __construct()
    {
        parent::__construct(new DiceChanceEvaluator(new Roll1d6()));
    }

    protected function getDataFileName()
    {
        return __DIR__ . '/data/wounds.csv';
    }

    protected function getExpectedDataHeader()
    {
        return [Wounds::WOUNDS];
    }

    /**
     * @param WoundsBonus $bonus
     *
     * @return Wounds
     */
    public function toWounds(WoundsBonus $bonus)
    {
        return $this->toMeasurement($bonus);
    }

    /**
     * @param int $bonusValue
     *
     * @return WoundsBonus
     */
    protected function createBonus($bonusValue)
    {
        return new WoundsBonus($bonusValue, $this);
    }

    /**
     * @param float $value
     * @param string $unit
     *
     * @return Wounds
     */
    protected function convertToMeasurement($value, $unit)
    {
        return new Wounds($value, $unit, $this);
    }

}
