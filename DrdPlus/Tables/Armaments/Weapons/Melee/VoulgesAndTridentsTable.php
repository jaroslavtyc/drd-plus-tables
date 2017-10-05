<?php
declare(strict_types=1); // on PHP 7+ are standard PHP methods strict to types of given parameters

namespace DrdPlus\Tables\Armaments\Weapons\Melee;

use DrdPlus\Codes\Armaments\MeleeWeaponCode;
use DrdPlus\Codes\Armaments\WeaponCategoryCode;
use DrdPlus\Codes\Body\WoundTypeCode;
use DrdPlus\Properties\Base\Strength;
use DrdPlus\Tables\Armaments\Weapons\Melee\Partials\MeleeWeaponsTable;
use DrdPlus\Tables\Measurements\Weight\Weight;

/**
 * See PPH page 85, @link https://pph.drdplus.info/#tabulka_zbrani_jednorucni_zbrane
 */
class VoulgesAndTridentsTable extends MeleeWeaponsTable
{
    /**
     * @return string
     */
    protected function getDataFileName(): string
    {
        return __DIR__ . '/data/voulges_and_tridents.csv';
    }

    /**
     * @param MeleeWeaponCode $meleeWeaponCode you need a code even for a custom weapon, so prove now
     * @param Strength $requiredStrength
     * @param int $weaponLength
     * @param int $offensiveness
     * @param int $wounds
     * @param WoundTypeCode $woundTypeCode
     * @param int $cover
     * @param Weight $weight
     * @param bool $twoHandedOnly
     * @return bool
     * @throws \DrdPlus\Tables\Armaments\Weapons\Exceptions\NewWeaponIsNotOfRequiredType
     * @throws \DrdPlus\Tables\Armaments\Weapons\Exceptions\DifferentWeaponIsUnderSameName
     */
    public function addNewVoulgeOrTrident(
        MeleeWeaponCode $meleeWeaponCode,
        Strength $requiredStrength,
        int $weaponLength,
        int $offensiveness,
        int $wounds,
        WoundTypeCode $woundTypeCode,
        int $cover,
        Weight $weight,
        bool $twoHandedOnly
    ): bool
    {
        return $this->addCustomMeleeWeapon(
            $meleeWeaponCode,
            WeaponCategoryCode::getIt(WeaponCategoryCode::VOULGES_AND_TRIDENTS),
            $requiredStrength,
            $weaponLength,
            $offensiveness,
            $wounds,
            $woundTypeCode,
            $cover,
            $weight,
            $twoHandedOnly
        );
    }
}