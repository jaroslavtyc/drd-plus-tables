<?php
namespace DrdPlus\Tests\Tables\Armaments\Armors;

use DrdPlus\Tables\Armaments\Armors\AbstractArmorsTable;
use DrdPlus\Tests\Tables\TableTest;

abstract class AbstractArmorsTableTest extends TableTest
{
    /**
     * @test
     */
    public function I_can_get_header()
    {
        $sutClass = self::getSutClass();
        /** @var AbstractArmorsTable $armorsTable */
        $armorsTable = new $sutClass();
        self::assertSame(
            [[$this->getRowHeaderName(), 'required_strength', 'restriction', 'protection', 'weight']],
            $armorsTable->getHeader()
        );
    }

    /**
     * @test
     */
    public function I_can_get_all_values()
    {
        $sutClass = self::getSutClass();
        /** @var AbstractArmorsTable $armorsTable */
        $armorsTable = new $sutClass();
        self::assertSame($this->assembleIndexedValues($this->provideArmorAndValue()), $armorsTable->getIndexedValues());
    }

    private function assembleIndexedValues(array $values)
    {
        $indexedValues = [];
        foreach ($values as $row) {
            list($armor, $parameterName, $parameterValue) = $row;
            if (!array_key_exists($armor, $indexedValues)) {
                $indexedValues[$armor] = [];
            }
            $indexedValues[$armor][$parameterName] = $parameterValue;
        }

        return $indexedValues;
    }

    /**
     * @return string
     */
    protected function getRowHeaderName()
    {
        $sutClass = self::getSutClass();
        $baseName = preg_replace('~(?:.+[\\\])?(\w+)~', '$1', $sutClass);

        $rawHeaderName = str_replace('sTable', '', $baseName);

        return implode('_', array_map(
            function ($headerNamePart) {
                return lcfirst($headerNamePart);
            },
            preg_split('~([A-Z][a-z]+)~', $rawHeaderName, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY)
        ));
    }

    /**
     * @test
     * @dataProvider provideArmorAndValue
     * @param string $armorCode
     * @param string $valueName
     * @param mixed $expectedValue
     */
    public function I_can_get_values_for_every_armor($armorCode, $valueName, $expectedValue)
    {
        $sutClass = self::getSutClass();
        /** @var AbstractArmorsTable $armorsTable */
        $armorsTable = new $sutClass();
        $value = $armorsTable->getValue([$armorCode], $valueName);
        self::assertSame($expectedValue, $value);
        $getValueNameOf = 'get' . implode(array_map(
                function ($namePart) {
                    return ucfirst($namePart);
                },
                explode('_', $valueName)
            )) . 'Of';
        self::assertSame($value, $armorsTable->$getValueNameOf($armorCode));
    }

    abstract public function provideArmorAndValue();

    /**
     * @test
     * @expectedException \DrdPlus\Tables\Armaments\Exceptions\UnknownArmor
     */
    public function I_can_not_get_value_for_unknown_armor()
    {
        $sutClass = self::getSutClass();
        /** @var AbstractArmorsTable $armorsTable */
        $armorsTable = new $sutClass();
        $armorsTable->getProtectionOf('skeleton armor of never-life');
    }

}