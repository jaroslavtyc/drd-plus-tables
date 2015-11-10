<?php
namespace DrdPlus\Tables\Measurements\Wounds;

use DrdPlus\Tables\Measurements\Parts\AbstractMeasurementWithBonus;
use Granam\Integer\Tools\ToInteger;

class Wounds extends AbstractMeasurementWithBonus
{
    const WOUNDS = 'wounds';

    /**
     * @var WoundsTable
     */
    private $woundsTable;

    public function __construct($value, $unit, WoundsTable $woundsTable)
    {
        $this->woundsTable = $woundsTable;
        parent::__construct($value, $unit);
    }

    /**
     * @return int
     */
    public function getValue()
    {
        // turning float to integer (without value lost)
        return ToInteger::toInteger(parent::getValue());
    }

    /**
     * @return array|string[]
     */
    public function getPossibleUnits()
    {
        return [self::WOUNDS];
    }

    /**
     * @return WoundsBonus
     */
    public function getBonus()
    {
        return $this->woundsTable->toBonus($this);
    }
}