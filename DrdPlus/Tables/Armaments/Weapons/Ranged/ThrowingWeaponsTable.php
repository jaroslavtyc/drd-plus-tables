<?php
namespace DrdPlus\Tables\Armaments\Weapons\Ranged;

use DrdPlus\Tables\Armaments\Weapons\Ranged\Partials\RangedWeaponsTable;

/**
 * See PPH page 88 right column, @link https://pph.drdplus.jaroslavtyc.com/#tabulka_strelnych_a_vrhacich_zbrani
 */
class ThrowingWeaponsTable extends RangedWeaponsTable
{
    /**
     * @return string
     */
    protected function getDataFileName()
    {
        return __DIR__ . '/data/throwing_weapons.csv';
    }

    const WEAPON = 'weapon';

    /**
     * @return array|string[]
     */
    protected function getRowsHeader()
    {
        return [self::WEAPON];
    }

}