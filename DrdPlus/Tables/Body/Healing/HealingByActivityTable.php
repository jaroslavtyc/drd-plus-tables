<?php
namespace DrdPlus\Tables\Body\Healing;

use DrdPlus\Tables\Partials\AbstractFileTable;
use DrdPlus\Tables\Partials\Exceptions\RequiredRowNotFound;
use Granam\Tools\ValueDescriber;

/**
 * See PPH page 81 left column top, @link https://pph.drdplus.jaroslavtyc.com/#tabulka_leceni_podle_cinnosti_postavy
 */
class HealingByActivityTable extends AbstractFileTable
{
    /**
     * @return string
     */
    protected function getDataFileName()
    {
        return __DIR__ . '/data/healing_by_activity.csv';
    }

    const BONUS = 'bonus';

    /**
     * @return array|string[]
     */
    protected function getExpectedDataHeaderNamesToTypes()
    {
        return [self::BONUS => self::INTEGER];
    }

    const SITUATION = 'situation';

    /**
     * @return array|string[]
     */
    protected function getRowsHeader()
    {
        return [self::SITUATION];
    }

    /**
     * @param string $activityCode
     * @return int
     * @throws \DrdPlus\Tables\Body\Healing\Exceptions\UnknownCodeOfHealingInfluence
     * @throws \DrdPlus\Tables\Partials\Exceptions\RequiredColumnNotFound
     */
    public function getHealingBonusByActivity($activityCode)
    {
        try {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $this->getValue([$activityCode], 'bonus');
        } catch (RequiredRowNotFound $requiredRowDataNotFound) {
            throw new Exceptions\UnknownCodeOfHealingInfluence(
                'Unknown influence on healing code ' . ValueDescriber::describe($activityCode)
            );
        }
    }
}