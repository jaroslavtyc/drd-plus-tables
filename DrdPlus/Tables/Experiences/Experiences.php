<?php
namespace DrdPlus\Tables\Experiences;

use DrdPlus\Tables\Parts\AbstractMeasurementWithBonus;
use Granam\Integer\Tools\ToInteger;

/**
 * @method int getValue()
 * @see \DrdPlus\Tables\Experiences\Experiences::normalizeValue
 */
class Experiences extends AbstractMeasurementWithBonus
{
    const EXPERIENCES = 'experiences';

    /**
     * @var ExperiencesTable
     */
    private $experiencesTable;

    public function __construct($value, $unit, ExperiencesTable $experiencesTable)
    {
        parent::__construct($value, $unit);
        $this->experiencesTable = $experiencesTable;
    }

    /**
     * @param mixed $value
     *
     * @return int
     */
    protected function normalizeValue($value)
    {
        return ToInteger::toInteger($value);
    }

    /**
     * @return array|string[]
     */
    public function getPossibleUnits()
    {
        return [self::EXPERIENCES];
    }

    /**
     * @return Level
     */
    public function getLevel()
    {
        return $this->getBonus();
    }

    /**
     * Final level, achieved by sparing current experiences from total zero
     *
     * @return Level
     */
    public function getTotalLevel()
    {
        return $this->experiencesTable->toTotalLevel($this);
    }

    /**
     * @return Level
     */
    public function getBonus()
    {
        return $this->experiencesTable->toLevel($this);
    }

}