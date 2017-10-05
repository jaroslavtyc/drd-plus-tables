<?php
declare(strict_types=1); // on PHP 7+ are standard PHP methods strict to types of given parameters

namespace DrdPlus\Tests\Tables\Measurements\Experiences;

use DrdPlus\Tables\Measurements\Bonus;
use DrdPlus\Tables\Measurements\Experiences\Experiences;
use DrdPlus\Tables\Measurements\Experiences\ExperiencesTable;
use DrdPlus\Tables\Measurements\Experiences\Level;
use DrdPlus\Tables\Measurements\Wounds\WoundsTable;
use DrdPlus\Tests\Tables\Measurements\AbstractTestOfBonus;
use Mockery\MockInterface;

class LevelTest extends AbstractTestOfBonus
{
    /**
     * @test
     */
    public function I_can_create_bonus()
    {
        $sut = $this->createSut($value = 20);
        self::assertInstanceOf(Bonus::class, $sut);
        self::assertSame($value, $sut->getValue());
    }

    protected function getTableInstance()
    {
        return new ExperiencesTable(new WoundsTable());
    }

    protected function getNameOfMeasurementGetter()
    {
        return 'getExperiences';
    }

    protected function getMeasurementClass()
    {
        return Experiences::class;
    }

    /**
     * @test
     */
    public function I_can_get_level_value()
    {
        $level = new Level($levelValue = 20, $this->getExperiencesTable());
        self::assertSame($levelValue, $level->getValue());
    }

    protected function findTable()
    {
        return $this->getExperiencesTable();
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
    public function I_can_get_experiences()
    {
        $level = new Level(11, $experiencesTable = $this->getExperiencesTable());
        $experiencesTable->shouldReceive('toExperiences')
            ->atLeast()->once()
            ->with($level)
            ->andReturn($experiences = $this->createExperiences());
        self::assertSame($experiences, $level->getExperiences());

        $level = new Level(5, $experiencesTable = $this->getExperiencesTable());
        $experiencesTable->shouldReceive('toTotalExperiences')
            ->atLeast()->once()
            ->with($level)
            ->andReturn($totalExperiences = $this->createExperiences());
        self::assertSame($totalExperiences, $level->getTotalExperiences());
    }

    /**
     * @return Experiences|MockInterface
     */
    private function createExperiences(): Experiences
    {
        return $this->mockery(Experiences::class);
    }

    /**
     * @test
     * @expectedException \DrdPlus\Tables\Measurements\Experiences\Exceptions\MaxLevelOverflow
     */
    public function I_cannot_create_higher_level_than_cap()
    {
        new Level(21, $this->getExperiencesTable());
    }

    /**
     * @test
     * @expectedException \DrdPlus\Tables\Measurements\Experiences\Exceptions\MinLevelUnderflow
     */
    public function I_cannot_create_negative_level()
    {
        new Level(-1, $this->getExperiencesTable());
    }

    /**
     * @test
     */
    public function I_can_create_zero_level()
    {
        $zeroLevel = new Level(0, $this->getExperiencesTable());
        self::assertSame(0, $zeroLevel->getValue());
    }
}
