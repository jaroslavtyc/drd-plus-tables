<?php
namespace DrdPlus\Tables\Combat\Attacks\Partials;

use DrdPlus\Tables\Measurements\Distance\Distance;
use DrdPlus\Tables\Partials\AbstractFileTable;
use Granam\Float\Tools\ToFloat;

abstract class AbstractAttackNumberByDistanceTable extends AbstractFileTable
{

    const DISTANCE_BONUS = 'distance_bonus';
    const RANGED_ATTACK_NUMBER_MODIFIER = 'ranged_attack_number_modifier';

    protected function getExpectedDataHeaderNamesToTypes(): array
    {
        return [
            self::DISTANCE_BONUS => self::INTEGER,
            self::RANGED_ATTACK_NUMBER_MODIFIER => self::INTEGER,
        ];
    }

    /**
     * @param Distance $distance
     * @return int
     */
    abstract public function getAttackNumberModifierByDistance(Distance $distance);

    /**
     * Values may be already ordered from file, but have to be sure.
     *
     * @return array
     */
    protected function getOrderedByDistanceAsc()
    {
        $values = $this->getIndexedValues();
        uksort($values, function ($oneDistanceInMeters, $anotherDistanceInMeters) {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            $oneDistanceInMeters = ToFloat::toPositiveFloat($oneDistanceInMeters);
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            $anotherDistanceInMeters = ToFloat::toPositiveFloat($anotherDistanceInMeters);
            if ($oneDistanceInMeters < $anotherDistanceInMeters) {
                return -1; // lowest first
            }
            if ($oneDistanceInMeters > $anotherDistanceInMeters) {
                return 1;
            }

            // @codeCoverageIgnoreStart
            return 0;
            // @codeCoverageIgnoreEnds
        });

        return $values;
    }
}