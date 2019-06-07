<?php declare(strict_types=1);

namespace DrdPlus\Tests\Tables\Theurgist\Demons\DemonParameters;

use DrdPlus\Tables\Tables;
use DrdPlus\Tables\Theurgist\Demons\DemonParameters\DemonRadius;
use DrdPlus\Tests\Tables\Theurgist\Spells\SpellParameters\Partials\CastingParameterTest;

class DemonRadiusTest extends CastingParameterTest
{
    /**
     * @test
     */
    public function I_can_get_radius_value()
    {
        $demonRadius = new DemonRadius([123, 0], Tables::getIt());
        self::assertSame(123, $demonRadius->getValue());
    }
}