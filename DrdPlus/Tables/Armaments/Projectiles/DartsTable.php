<?php
namespace DrdPlus\Tables\Armaments\Projectiles;

use DrdPlus\Tables\Armaments\Projectiles\Partials\ProjectilesTable;

/**
 * See PPH page 88 right column, @link https://pph.drdplus.jaroslavtyc.com/#tabulka_strelnych_a_vrhacich_zbrani
 */
class DartsTable extends ProjectilesTable
{
    protected function getDataFileName(): string
    {
        return __DIR__ . '/data/darts.csv';
    }

}