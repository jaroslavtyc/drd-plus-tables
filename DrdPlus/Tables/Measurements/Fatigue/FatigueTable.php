<?php
namespace DrdPlus\Tables\Measurements\Fatigue;

use DrdPlus\Tables\Parts\AbstractTable;
use DrdPlus\Tables\Measurements\Wounds\Wounds;
use DrdPlus\Tables\Measurements\Wounds\WoundsBonus;
use DrdPlus\Tables\Measurements\Wounds\WoundsTable;

/**
 * PPH page 165, top
 */
class FatigueTable extends AbstractTable
{
    /**
     * @var \DrdPlus\Tables\Measurements\Wounds\WoundsTable
     */
    private $woundsTable;

    public function __construct(WoundsTable $woundsTable)
    {
        // fatigue has the very same conversions as wounds have
        $this->woundsTable = $woundsTable;
    }

    public function getIndexedValues()
    {
        return $this->woundsTable->getIndexedValues();
    }

    protected function getRowsHeader()
    {
        return $this->woundsTable->getRowsHeader();
    }

    protected function getColumnsHeader()
    {
        return $this->woundsTable->getColumnsHeader();
    }

    /**
     * @param Fatigue $fatigue
     *
     * @return FatigueBonus
     */
    public function toBonus(Fatigue $fatigue)
    {
        return new FatigueBonus(
            $this->woundsTable->toBonus(new Wounds($fatigue->getValue(), $this->woundsTable, Wounds::WOUNDS))->getValue(),
            $this
        );
    }

    /**
     * @param FatigueBonus $bonus
     *
     * @return Fatigue
     */
    public function toFatigue(FatigueBonus $bonus)
    {
        return new Fatigue(
            $this->woundsTable->toWounds(new WoundsBonus($bonus->getValue(), $this->woundsTable))->getValue(),
            Fatigue::FATIGUE,
            $this
        );
    }

}
