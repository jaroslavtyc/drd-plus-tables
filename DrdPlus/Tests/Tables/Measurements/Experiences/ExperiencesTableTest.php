<?php
namespace DrdPlus\Tests\Tables\Measurements\Derived\Experiences;

use DrdPlus\Tables\Measurements\Experiences\Experiences;
use DrdPlus\Tables\Measurements\Experiences\ExperiencesTable;
use DrdPlus\Tables\Measurements\Experiences\Level;
use DrdPlus\Tables\Measurements\Wounds\WoundsTable;
use Granam\Tests\Tools\TestWithMockery;

class ExperiencesTableTest extends TestWithMockery
{
    /**
     * @test
     */
    public function I_can_get_headers_same_as_from_wounds_table()
    {
        $experiencesTable = new ExperiencesTable($woundsTable = new WoundsTable());

        $this->assertEquals($woundsTable->getHeader(), $experiencesTable->getHeader());
    }

    /**
     * @test
     */
    public function I_can_get_values_same_as_from_wounds_table()
    {
        $experiencesTable = new ExperiencesTable($woundsTable = new WoundsTable());

        $this->assertEquals($woundsTable->getValues(), $experiencesTable->getValues());
        $this->assertEquals($woundsTable->getIndexedValues(), $experiencesTable->getIndexedValues());
    }

    /**
     * @test
     */
    public function I_can_convert_experiences_to_level()
    {
        $experiencesTable = new ExperiencesTable($woundsTable = new WoundsTable());
        $experiences = new Experiences($experiencesValue = 123, $experiencesTable, Experiences::EXPERIENCES);

        $level = $experiencesTable->toLevel($experiences);
        $this->assertInstanceOf(Level::class, $level);
        $this->assertSame(17, $level->getValue());
    }

    /**
     * @test
     */
    public function I_can_convert_level_to_experiences()
    {
        $experiencesTable = new ExperiencesTable($woundsTable = new WoundsTable());
        $level = new Level($levelValue = 11, $experiencesTable);

        $this->assertSame(63, $experiencesTable->toExperiences($level)->getValue());
    }

    /**
     * @test
     */
    public function I_can_convert_level_to_total_experiences()
    {
        $experiencesTable = new ExperiencesTable($woundsTable = new WoundsTable());
        $firstLevel = new Level($levelValue = 1, $experiencesTable);
        $this->assertSame(
            0,
            $experiencesTable->toTotalExperiences($firstLevel, true /* main profession */)->getValue()
        );
        $this->assertSame(
            20,
            $experiencesTable->toTotalExperiences($firstLevel, false /* collateral profession */)->getValue()
        );

        $lastLevel = new Level($levelValue = 20, $experiencesTable);
        $this->assertSame(
            1447,
            $experiencesTable->toTotalExperiences($lastLevel, true /* main profession */)->getValue()
        );
        $this->assertSame(
            1467,
            $experiencesTable->toTotalExperiences($lastLevel, false /* collateral profession */)->getValue()
        );
    }

    /**
     * @test
     */
    public function I_can_convert_experiences_to_total_level()
    {
        $experiencesTable = new ExperiencesTable($woundsTable = new WoundsTable());
        $experiences = new Experiences($experiencesValue = 99, $experiencesTable, Experiences::EXPERIENCES);

        $level = $experiencesTable->toTotalLevel($experiences);
        $this->assertSame(14, $level->getValue());
    }
}
