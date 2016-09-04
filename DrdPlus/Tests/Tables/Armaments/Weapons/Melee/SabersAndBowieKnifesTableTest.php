<?php
namespace DrdPlus\Tests\Tables\Armaments\Weapons\Melee;

use DrdPlus\Codes\Armaments\MeleeWeaponCode;
use DrdPlus\Codes\WoundTypeCode;
use DrdPlus\Tables\Armaments\Weapons\Melee\Partials\MeleeWeaponsTable;
use DrdPlus\Tables\Armaments\Weapons\Melee\SabersAndBowieKnifesTable;
use DrdPlus\Tests\Tables\Armaments\Weapons\Melee\Partials\MeleeWeaponsTableTest;

class SabersAndBowieKnifesTableTest extends MeleeWeaponsTableTest
{
    public function provideWeaponAndNameWithValue()
    {
        return [
            [MeleeWeaponCode::MACHETE, MeleeWeaponsTable::REQUIRED_STRENGTH, 2],
            [MeleeWeaponCode::MACHETE, MeleeWeaponsTable::LENGTH, 1],
            [MeleeWeaponCode::MACHETE, MeleeWeaponsTable::OFFENSIVENESS, 2],
            [MeleeWeaponCode::MACHETE, MeleeWeaponsTable::WOUNDS, 2],
            [MeleeWeaponCode::MACHETE, MeleeWeaponsTable::WOUNDS_TYPE, WoundTypeCode::CUT],
            [MeleeWeaponCode::MACHETE, MeleeWeaponsTable::COVER, 2],
            [MeleeWeaponCode::MACHETE, MeleeWeaponsTable::WEIGHT, 1.0],
            [MeleeWeaponCode::MACHETE, MeleeWeaponsTable::TWO_HANDED, false],

            [MeleeWeaponCode::LIGHT_SABER, MeleeWeaponsTable::REQUIRED_STRENGTH, 3],
            [MeleeWeaponCode::LIGHT_SABER, MeleeWeaponsTable::LENGTH, 2],
            [MeleeWeaponCode::LIGHT_SABER, MeleeWeaponsTable::OFFENSIVENESS, 3],
            [MeleeWeaponCode::LIGHT_SABER, MeleeWeaponsTable::WOUNDS, 1],
            [MeleeWeaponCode::LIGHT_SABER, MeleeWeaponsTable::WOUNDS_TYPE, WoundTypeCode::CUT],
            [MeleeWeaponCode::LIGHT_SABER, MeleeWeaponsTable::COVER, 3],
            [MeleeWeaponCode::LIGHT_SABER, MeleeWeaponsTable::WEIGHT, 1.2],
            [MeleeWeaponCode::LIGHT_SABER, MeleeWeaponsTable::TWO_HANDED, false],

            [MeleeWeaponCode::BOWIE_KNIFE, MeleeWeaponsTable::REQUIRED_STRENGTH, 3],
            [MeleeWeaponCode::BOWIE_KNIFE, MeleeWeaponsTable::LENGTH, 1],
            [MeleeWeaponCode::BOWIE_KNIFE, MeleeWeaponsTable::OFFENSIVENESS, 2],
            [MeleeWeaponCode::BOWIE_KNIFE, MeleeWeaponsTable::WOUNDS, 3],
            [MeleeWeaponCode::BOWIE_KNIFE, MeleeWeaponsTable::WOUNDS_TYPE, WoundTypeCode::CUT],
            [MeleeWeaponCode::BOWIE_KNIFE, MeleeWeaponsTable::COVER, 3],
            [MeleeWeaponCode::BOWIE_KNIFE, MeleeWeaponsTable::WEIGHT, 1.2],
            [MeleeWeaponCode::BOWIE_KNIFE, MeleeWeaponsTable::TWO_HANDED, false],

            [MeleeWeaponCode::SABER, MeleeWeaponsTable::REQUIRED_STRENGTH, 6],
            [MeleeWeaponCode::SABER, MeleeWeaponsTable::LENGTH, 2],
            [MeleeWeaponCode::SABER, MeleeWeaponsTable::OFFENSIVENESS, 4],
            [MeleeWeaponCode::SABER, MeleeWeaponsTable::WOUNDS, 4],
            [MeleeWeaponCode::SABER, MeleeWeaponsTable::WOUNDS_TYPE, WoundTypeCode::CUT],
            [MeleeWeaponCode::SABER, MeleeWeaponsTable::COVER, 3],
            [MeleeWeaponCode::SABER, MeleeWeaponsTable::WEIGHT, 1.5],
            [MeleeWeaponCode::SABER, MeleeWeaponsTable::TWO_HANDED, false],

            [MeleeWeaponCode::HEAVY_SABER, MeleeWeaponsTable::REQUIRED_STRENGTH, 9],
            [MeleeWeaponCode::HEAVY_SABER, MeleeWeaponsTable::LENGTH, 2],
            [MeleeWeaponCode::HEAVY_SABER, MeleeWeaponsTable::OFFENSIVENESS, 4],
            [MeleeWeaponCode::HEAVY_SABER, MeleeWeaponsTable::WOUNDS, 6],
            [MeleeWeaponCode::HEAVY_SABER, MeleeWeaponsTable::WOUNDS_TYPE, WoundTypeCode::CUT],
            [MeleeWeaponCode::HEAVY_SABER, MeleeWeaponsTable::COVER, 4],
            [MeleeWeaponCode::HEAVY_SABER, MeleeWeaponsTable::WEIGHT, 2.0],
            [MeleeWeaponCode::HEAVY_SABER, MeleeWeaponsTable::TWO_HANDED, false],
        ];
    }

    /**
     * @test
     */
    public function I_can_get_every_weapon_by_weapon_codes_library()
    {
        $sabersAndBowieKnifesTable = new SabersAndBowieKnifesTable();
        foreach (MeleeWeaponCode::getSaberAndBowieKnifeCodes() as $saberAndBowieKnifeCode) {
            $row = $sabersAndBowieKnifesTable->getRow([$saberAndBowieKnifeCode]);
            self::assertNotEmpty($row);
        }
    }

}