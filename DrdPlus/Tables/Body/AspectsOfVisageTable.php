<?php
declare(strict_types=1); // on PHP 7+ are standard PHP methods strict to types of given parameters

namespace DrdPlus\Tables\Body;

use DrdPlus\Codes\Properties\PropertyCode;
use DrdPlus\Properties\Base\Agility;
use DrdPlus\Properties\Base\Charisma;
use DrdPlus\Properties\Base\Intelligence;
use DrdPlus\Properties\Base\Knack;
use DrdPlus\Properties\Base\Strength;
use DrdPlus\Properties\Base\Will;
use DrdPlus\Properties\Derived\Beauty;
use DrdPlus\Properties\Derived\Dangerousness;
use DrdPlus\Properties\Derived\Dignity;
use DrdPlus\Tables\Partials\AbstractTable;

/**
 * See PPH page 41 right column, @link https://pph.drdplus.info/#tabulka_aspektu_vzhledu
 */
class AspectsOfVisageTable extends AbstractTable
{
    public const ASPECT_OF_VISAGE = 'aspect_of_visage';

    /**
     * @return array|string[]
     */
    protected function getRowsHeader(): array
    {
        return [self::ASPECT_OF_VISAGE];
    }

    public const FIRST_PROPERTY = 'first_property';
    public const SECOND_PROPERTY = 'second_property';
    public const SUM_OF_FIRST_AND_SECOND_PROPERTY_DIVISOR = 'sum_of_first_and_second_property_divisor';
    public const THIRD_PROPERTY = 'third_property';
    public const THIRD_PROPERTY_DIVISOR = 'third_property_divisor';

    /**
     * @return array|string[]
     */
    protected function getColumnsHeader(): array
    {
        return [
            self::FIRST_PROPERTY,
            self::SECOND_PROPERTY,
            self::SUM_OF_FIRST_AND_SECOND_PROPERTY_DIVISOR,
            self::THIRD_PROPERTY,
            self::THIRD_PROPERTY_DIVISOR,
        ];
    }

    /**
     * @return array|string[]
     */
    public function getIndexedValues(): array
    {
        return [
            PropertyCode::BEAUTY => [
                self::FIRST_PROPERTY => PropertyCode::AGILITY,
                self::SECOND_PROPERTY => PropertyCode::KNACK,
                self::SUM_OF_FIRST_AND_SECOND_PROPERTY_DIVISOR => 2,
                self::THIRD_PROPERTY => PropertyCode::CHARISMA,
                self::THIRD_PROPERTY_DIVISOR => 2,
            ],
            PropertyCode::DANGEROUSNESS => [
                self::FIRST_PROPERTY => PropertyCode::STRENGTH,
                self::SECOND_PROPERTY => PropertyCode::WILL,
                self::SUM_OF_FIRST_AND_SECOND_PROPERTY_DIVISOR => 2,
                self::THIRD_PROPERTY => PropertyCode::CHARISMA,
                self::THIRD_PROPERTY_DIVISOR => 2,
            ],
            PropertyCode::DIGNITY => [
                self::FIRST_PROPERTY => PropertyCode::INTELLIGENCE,
                self::SECOND_PROPERTY => PropertyCode::WILL,
                self::SUM_OF_FIRST_AND_SECOND_PROPERTY_DIVISOR => 2,
                self::THIRD_PROPERTY => PropertyCode::CHARISMA,
                self::THIRD_PROPERTY_DIVISOR => 2,
            ],
        ];
    }

    /**
     * @param Agility $agility
     * @param Knack $knack
     * @param Charisma $charisma
     * @return Beauty
     */
    public function getBeauty(Agility $agility, Knack $knack, Charisma $charisma): Beauty
    {
        return Beauty::getIt($agility, $knack, $charisma);
    }

    /**
     * @param Strength $strength
     * @param Will $will
     * @param Charisma $charisma
     * @return Dangerousness
     */
    public function getDangerousness(Strength $strength, Will $will, Charisma $charisma): Dangerousness
    {
        return Dangerousness::getIt($strength, $will, $charisma);
    }

    /**
     * @param Intelligence $intelligence
     * @param Will $will
     * @param Charisma $charisma
     * @return Dignity
     */
    public function getDignity(Intelligence $intelligence, Will $will, Charisma $charisma): Dignity
    {
        return Dignity::getIt($intelligence, $will, $charisma);
    }

}