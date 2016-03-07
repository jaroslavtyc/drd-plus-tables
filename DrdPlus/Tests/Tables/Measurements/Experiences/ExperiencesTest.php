<?php
namespace DrdPlus\Tests\Tables\Measurements\Experiences;

use DrdPlus\Tables\Measurements\Experiences\Experiences;
use DrdPlus\Tables\Measurements\Experiences\ExperiencesTable;
use DrdPlus\Tables\Table;
use DrdPlus\Tests\Tables\Measurements\AbstractTestOfMeasurement;

class ExperiencesTest extends AbstractTestOfMeasurement
{

    protected function createSutWithTable($sutClass, $amount, $unit, Table $table)
    {
        return new $sutClass($amount, $table, $unit);
    }

    /**
     * @test
     */
    public function I_can_get_experiences()
    {
        $experiences = new Experiences(
            $value = 456,
            $this->getExperiencesTable(),
            Experiences::EXPERIENCES
        );
        $this->assertSame($value, $experiences->getValue());
    }

    /**
     * @return ExperiencesTable|\Mockery\MockInterface
     */
    private function getExperiencesTable()
    {
        return $this->mockery(ExperiencesTable::class);
    }

    /**
     * @test
     */
    public function I_can_get_level()
    {
        $experiences = new Experiences(
            $value = 111,
            $experiencesTable = $this->getExperiencesTable(),
            Experiences::EXPERIENCES
        );
        $experiencesTable->shouldReceive('toLevel')
            ->atLeast()->once()
            ->with($experiences)
            ->andReturn($level = 222);
        $this->assertSame($level, $experiences->getLevel());
    }

    /**
     * @test
     */
    public function I_can_get_total_level()
    {
        $experiences = new Experiences(
            $value = 123,
            $experiencesTable = $this->getExperiencesTable(),
            Experiences::EXPERIENCES
        );
        $experiencesTable->shouldReceive('toTotalLevel')
            ->atLeast()->once()
            ->with($experiences)
            ->andReturn($level = 456);
        $this->assertSame($level, $experiences->getTotalLevel());
    }

}
