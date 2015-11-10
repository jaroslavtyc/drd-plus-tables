<?php
namespace DrdPlus\Tables\Races;

class SizeAndWeightTable extends AbstractTable
{
    /**
     * @return string
     */
    protected function getDataFileName()
    {
        return __DIR__ . '/data/size_and_weight.csv';
    }

    const HEIGHT_IN_CM = 'Height in cm';
    const WEIGHT_IN_KG = 'Weight in kg';
    const SIZE = 'Size';

    /**
     * @return array|string
     */
    protected function getExpectedColumnsHeader()
    {
        return [
            self::HEIGHT_IN_CM => self::FLOAT,
            self::WEIGHT_IN_KG => self::FLOAT,
            self::SIZE => self::INTEGER,
        ];
    }

    /**
     * @return array
     */
    protected function getExpectedRowsHeader()
    {
        return [
            RacesTable::RACE,
            RacesTable::SUBRACE
        ];
    }

    public function getCommonHumanModifiers()
    {
        return $this->getHumanModifiers();
    }

    private function getHumanModifiers()
    {
        return $this->getRaceModifiers(RacesTable::HUMAN, '');
    }

    private function getRaceModifiers($race, $subrace)
    {
        return [
            self::HEIGHT_IN_CM => $this->getValue([$race, $subrace], self::HEIGHT_IN_CM),
            self::WEIGHT_IN_KG => $this->getValue([$race, $subrace], self::WEIGHT_IN_KG),
            self::SIZE => $this->getValue([$race, $subrace], self::SIZE),
        ];
    }

    public function getHighlanderModifiers()
    {
        return $this->getHumanModifiers();
    }

    public function getCommonDwarfModifier()
    {
        return $this->getDwarfModifiers();
    }

    private function getDwarfModifiers()
    {
        return $this->getRaceModifiers(RacesTable::DWARF, '');
    }

    public function getWoodDwarfModifier()
    {
        return $this->getDwarfModifiers();
    }

    public function getMountainDwarfModifier()
    {
        return $this->getDwarfModifiers();
    }

    public function getCommonElfModifiers()
    {
        return $this->getElfModifiers();
    }

    private function getElfModifiers()
    {
        return $this->getRaceModifiers(RacesTable::ELF, '');
    }

    public function getGreenElfModifiers()
    {
        return $this->getElfModifiers();
    }

    public function getDarkElfModifiers()
    {
        return $this->getElfModifiers();
    }

    public function getCommonHobbitModifiers()
    {
        return $this->getRaceModifiers(RacesTable::HOBBIT, '');
    }

    public function getCommonKrollModifier()
    {
        return $this->getKrollModifiers();
    }

    private function getKrollModifiers()
    {
        return $this->getRaceModifiers(RacesTable::KROLL, '');
    }

    public function getWildKrollModifier()
    {
        return $this->getKrollModifiers();
    }

    public function getCommonOrcModifiers()
    {
        return $this->getRaceModifiers(RacesTable::ORC, RacesTable::COMMON);
    }

    public function getGoblinModifiers()
    {
        return $this->getRaceModifiers(RacesTable::ORC, RacesTable::GOBLIN);
    }

    public function getSkurutModifiers()
    {
        return $this->getRaceModifiers(RacesTable::ORC, RacesTable::SKURUT);
    }

}