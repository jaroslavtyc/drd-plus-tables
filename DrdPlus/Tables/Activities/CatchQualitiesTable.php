<?php
namespace DrdPlus\Tables\Activities;

use DrdPlus\Codes\FoodTypeCode;
use DrdPlus\Tables\Partials\AbstractFileTable;
use Granam\Integer\IntegerInterface;

/**
 * See PPH page 132 right column, @link https://pph.drdplus.jaroslavtyc.com/#tabulka_ulovku
 */
class CatchQualitiesTable extends AbstractFileTable
{
    /**
     * @return string
     */
    protected function getDataFileName()
    {
        return __DIR__ . '/data/catch_qualities.csv';
    }

    const CATCH_QUALITY = 'catch_quality';
    const HEALING_AND_REST = 'healing_and_rest';

    /**
     * @return array|string[]
     */
    protected function getExpectedDataHeaderNamesToTypes()
    {
        return [
            self::CATCH_QUALITY => self::POSITIVE_INTEGER,
            self::HEALING_AND_REST => self::INTEGER,
        ];
    }

    const FOOD_TYPE = 'food_type';

    /**
     * @return array|string[]
     */
    protected function getRowsHeader()
    {
        return [
            self::FOOD_TYPE,
        ];
    }

    /**
     * @param IntegerInterface $catchQuality
     * @return int
     */
    public function getHealingAndRestByCatchQuality(IntegerInterface $catchQuality)
    {
        $healingAndRest = -7;
        $catchQualityValue = $catchQuality->getValue();
        foreach ($this->getIndexedValues() as $foodType => $row) {
            if ($row[self::CATCH_QUALITY] > $catchQualityValue) {
                break;
            }
            $healingAndRest = $row[self::HEALING_AND_REST];
        }

        return $healingAndRest;
    }

    /**
     * @param IntegerInterface $catchQuality
     * @return array|FoodTypeCode[]
     */
    public function getPossibleFoodTypesByCatchQuality(IntegerInterface $catchQuality)
    {
        $possibleFoodTypes = [];
        $catchQualityValue = $catchQuality->getValue();
        foreach ($this->getIndexedValues() as $foodType => $row) {
            if ($row[self::CATCH_QUALITY] > $catchQualityValue) {
                break;
            }
            $possibleFoodTypes[] = FoodTypeCode::getIt($foodType);
        }

        return $possibleFoodTypes;
    }

}