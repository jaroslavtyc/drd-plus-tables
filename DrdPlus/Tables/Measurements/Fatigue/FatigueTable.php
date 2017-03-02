<?php
namespace DrdPlus\Tables\Measurements\Fatigue;

use DrdPlus\Tables\Partials\AbstractTable;
use DrdPlus\Tables\Measurements\Wounds\Wounds;
use DrdPlus\Tables\Measurements\Wounds\WoundsBonus;
use DrdPlus\Tables\Measurements\Wounds\WoundsTable;

/**
 * Note: fatigue table is equal to wounds table.
 * See PPH page 165 top, @link https://pph.drdplus.jaroslavtyc.com/#tabulka_zraneni_a_unavy
 */
class FatigueTable extends AbstractTable
{
    /**
     * @var \DrdPlus\Tables\Measurements\Wounds\WoundsTable
     */
    private $woundsTable;

    /**
     * @param WoundsTable $woundsTable
     */
    public function __construct(WoundsTable $woundsTable)
    {
        // fatigue has the very same conversions as wounds have
        $this->woundsTable = $woundsTable;
    }

    /**
     * @return array|\string[][]
     */
    public function getIndexedValues(): array
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $this->woundsTable->getIndexedValues();
    }

    /**
     * @return array|\string[][]
     */
    protected function getRowsHeader(): array
    {
        return $this->woundsTable->getRowsHeader();
    }

    /**
     * @return array|\string[]
     */
    protected function getColumnsHeader(): array
    {
        return $this->woundsTable->getColumnsHeader();
    }

    /**
     * @param Fatigue $fatigue
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