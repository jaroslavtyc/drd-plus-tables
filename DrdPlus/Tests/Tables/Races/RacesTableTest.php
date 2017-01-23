<?php
namespace DrdPlus\Tests\Tables\Races;

use DrdPlus\Codes\GenderCode;
use DrdPlus\Codes\Properties\PropertyCode;
use DrdPlus\Codes\RaceCode;
use DrdPlus\Codes\SubRaceCode;
use DrdPlus\Tables\Measurements\Weight\WeightTable;
use DrdPlus\Tables\Races\FemaleModifiersTable;
use DrdPlus\Tables\Races\RacesTable;
use DrdPlus\Tests\Tables\TableTest;

class RacesTableTest extends TableTest
{

    /**
     * @test
     */
    public function I_can_get_header()
    {
        $racesTable = new RacesTable();
        self::assertEquals(
            [[
                RacesTable::RACE,
                RacesTable::SUBRACE,
                PropertyCode::STRENGTH,
                PropertyCode::AGILITY,
                PropertyCode::KNACK,
                PropertyCode::WILL,
                PropertyCode::INTELLIGENCE,
                PropertyCode::CHARISMA,
                PropertyCode::TOUGHNESS,
                PropertyCode::HEIGHT_IN_CM,
                PropertyCode::WEIGHT_IN_KG,
                PropertyCode::SIZE,
                PropertyCode::SENSES,
                PropertyCode::REMARKABLE_SENSE,
                PropertyCode::INFRAVISION,
                PropertyCode::NATIVE_REGENERATION,
                PropertyCode::REQUIRES_DM_AGREEMENT,
                PropertyCode::AGE,
            ]],
            $racesTable->getHeader()
        );
    }

    /**
     * @test
     */
    public function I_can_get_values_in_simple_structure()
    {
        $racesTable = new RacesTable();
        self::assertEquals(
            [
                [RaceCode::HUMAN, SubRaceCode::COMMON, 0, 0, 0, 0, 0, 0, 0, 180.0, 80.0, 0, 0, '', false, false, false, 15],
                [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, 1, 0, 0, 1, -1, -1, 0, 180.0, 80.0, 0, 0, '', false, false, false, 14],
                [RaceCode::ELF, SubRaceCode::COMMON, -1, 1, 1, -2, 1, 1, -1, 160.0, 50.0, -1, 0, PropertyCode::SIGHT, false, false, false, 32],
                [RaceCode::ELF, SubRaceCode::GREEN, -1, 1, 0, -1, 1, 1, -1, 160.0, 50.0, -1, 0, PropertyCode::SIGHT, false, false, false, 30],
                [RaceCode::ELF, SubRaceCode::DARK, 0, 0, 0, 0, 1, 0, -1, 160.0, 50.0, -1, 0, PropertyCode::SIGHT, true, false, true, 30],
                [RaceCode::DWARF, SubRaceCode::COMMON, 1, -1, 0, 2, -1, -2, 1, 140.0, 70.0, 0, -1, PropertyCode::TOUCH, true, false, false, 22],
                [RaceCode::DWARF, SubRaceCode::WOOD, 1, -1, 0, 1, -1, -1, 1, 140.0, 70.0, 0, -1, PropertyCode::TOUCH, true, false, false, 20],
                [RaceCode::DWARF, SubRaceCode::MOUNTAIN, 2, -1, 0, 2, -2, -2, 1, 140.0, 70.0, 0, -1, PropertyCode::TOUCH, true, false, false, 18],
                [RaceCode::HOBBIT, SubRaceCode::COMMON, -3, 1, 1, 0, -1, 2, 0, 110.0, 40.0, -2, 0, PropertyCode::TASTE, false, false, false, 25],
                [RaceCode::KROLL, SubRaceCode::COMMON, 3, -2, -1, 1, -3, -1, 0, 220.0, 120.0, 3, 0, PropertyCode::HEARING, false, true, false, 12],
                [RaceCode::KROLL, SubRaceCode::WILD, 3, -1, -2, 2, -3, -2, 0, 220.0, 120.0, 3, 0, PropertyCode::HEARING, false, true, true, 11],
                [RaceCode::ORC, SubRaceCode::COMMON, 0, 2, 0, -1, 0, -2, 0, 160.0, 60.0, -1, 1, PropertyCode::SMELL, true, false, true, 10],
                [RaceCode::ORC, SubRaceCode::SKURUT, 1, 1, -1, 0, 0, -2, 0, 180.0, 90.0, 1, 1, PropertyCode::SMELL, true, false, true, 13],
                [RaceCode::ORC, SubRaceCode::GOBLIN, -1, 2, 1, -2, 0, -1, 0, 150.0, 55.0, -1, 1, PropertyCode::SMELL, true, false, true, 9],
            ],
            $racesTable->getValues()
        );
    }

    /**
     * @test
     */
    public function I_can_get_common_human_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getCommonHumanModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => 0,
                PropertyCode::AGILITY => 0,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => 0,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => 0,
                PropertyCode::TOUGHNESS => 0,
                PropertyCode::HEIGHT_IN_CM => 180.0,
                PropertyCode::WEIGHT_IN_KG => 80.0,
                PropertyCode::SIZE => 0,
                PropertyCode::SENSES => 0,
                PropertyCode::REMARKABLE_SENSE => '',
                PropertyCode::INFRAVISION => false,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => false,
                PropertyCode::AGE => 15,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_highlander_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getHighlanderModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => 1,
                PropertyCode::AGILITY => 0,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => 1,
                PropertyCode::INTELLIGENCE => -1,
                PropertyCode::CHARISMA => -1,
                PropertyCode::TOUGHNESS => 0,
                PropertyCode::HEIGHT_IN_CM => 180.0,
                PropertyCode::WEIGHT_IN_KG => 80.0,
                PropertyCode::SIZE => 0,
                PropertyCode::SENSES => 0,
                PropertyCode::REMARKABLE_SENSE => '',
                PropertyCode::INFRAVISION => false,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => false,
                PropertyCode::AGE => 14,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_common_dwarf_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getCommonDwarfModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => 1,
                PropertyCode::AGILITY => -1,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => 2,
                PropertyCode::INTELLIGENCE => -1,
                PropertyCode::CHARISMA => -2,
                PropertyCode::TOUGHNESS => 1,
                PropertyCode::HEIGHT_IN_CM => 140.0,
                PropertyCode::WEIGHT_IN_KG => 70.0,
                PropertyCode::SIZE => 0,
                PropertyCode::SENSES => -1,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::TOUCH,
                PropertyCode::INFRAVISION => true,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => false,
                PropertyCode::AGE => 22,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_wood_dwarf_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getWoodDwarfModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => 1,
                PropertyCode::AGILITY => -1,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => 1,
                PropertyCode::INTELLIGENCE => -1,
                PropertyCode::CHARISMA => -1,
                PropertyCode::TOUGHNESS => 1,
                PropertyCode::HEIGHT_IN_CM => 140.0,
                PropertyCode::WEIGHT_IN_KG => 70.0,
                PropertyCode::SIZE => 0,
                PropertyCode::SENSES => -1,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::TOUCH,
                PropertyCode::INFRAVISION => true,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => false,
                PropertyCode::AGE => 20,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_mountain_dwarf_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getMountainDwarfModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => 2,
                PropertyCode::AGILITY => -1,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => 2,
                PropertyCode::INTELLIGENCE => -2,
                PropertyCode::CHARISMA => -2,
                PropertyCode::TOUGHNESS => 1,
                PropertyCode::HEIGHT_IN_CM => 140.0,
                PropertyCode::WEIGHT_IN_KG => 70.0,
                PropertyCode::SIZE => 0,
                PropertyCode::SENSES => -1,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::TOUCH,
                PropertyCode::INFRAVISION => true,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => false,
                PropertyCode::AGE => 18,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_common_elf_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getCommonElfModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => -1,
                PropertyCode::AGILITY => 1,
                PropertyCode::KNACK => 1,
                PropertyCode::WILL => -2,
                PropertyCode::INTELLIGENCE => 1,
                PropertyCode::CHARISMA => 1,
                PropertyCode::TOUGHNESS => -1,
                PropertyCode::HEIGHT_IN_CM => 160.0,
                PropertyCode::WEIGHT_IN_KG => 50.0,
                PropertyCode::SIZE => -1,
                PropertyCode::SENSES => 0,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::SIGHT,
                PropertyCode::INFRAVISION => false,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => false,
                PropertyCode::AGE => 32,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_green_elf_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getGreenElfModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => -1,
                PropertyCode::AGILITY => 1,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => -1,
                PropertyCode::INTELLIGENCE => 1,
                PropertyCode::CHARISMA => 1,
                PropertyCode::TOUGHNESS => -1,
                PropertyCode::HEIGHT_IN_CM => 160.0,
                PropertyCode::WEIGHT_IN_KG => 50.0,
                PropertyCode::SIZE => -1,
                PropertyCode::SENSES => 0,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::SIGHT,
                PropertyCode::INFRAVISION => false,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => false,
                PropertyCode::AGE => 30,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_dark_elf_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getDarkElfModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => 0,
                PropertyCode::AGILITY => 0,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => 0,
                PropertyCode::INTELLIGENCE => 1,
                PropertyCode::CHARISMA => 0,
                PropertyCode::TOUGHNESS => -1,
                PropertyCode::HEIGHT_IN_CM => 160.0,
                PropertyCode::WEIGHT_IN_KG => 50.0,
                PropertyCode::SIZE => -1,
                PropertyCode::SENSES => 0,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::SIGHT,
                PropertyCode::INFRAVISION => true,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => true,
                PropertyCode::AGE => 30,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_common_hobbit_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getCommonHobbitModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => -3,
                PropertyCode::AGILITY => 1,
                PropertyCode::KNACK => 1,
                PropertyCode::WILL => 0,
                PropertyCode::INTELLIGENCE => -1,
                PropertyCode::CHARISMA => 2,
                PropertyCode::TOUGHNESS => 0,
                PropertyCode::HEIGHT_IN_CM => 110.0,
                PropertyCode::WEIGHT_IN_KG => 40.0,
                PropertyCode::SIZE => -2,
                PropertyCode::SENSES => 0,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::TASTE,
                PropertyCode::INFRAVISION => false,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => false,
                PropertyCode::AGE => 25,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_common_kroll_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getCommonKrollModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => 3,
                PropertyCode::AGILITY => -2,
                PropertyCode::KNACK => -1,
                PropertyCode::WILL => 1,
                PropertyCode::INTELLIGENCE => -3,
                PropertyCode::CHARISMA => -1,
                PropertyCode::TOUGHNESS => 0,
                PropertyCode::HEIGHT_IN_CM => 220.0,
                PropertyCode::WEIGHT_IN_KG => 120.0,
                PropertyCode::SIZE => 3,
                PropertyCode::SENSES => 0,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::HEARING,
                PropertyCode::INFRAVISION => false,
                PropertyCode::NATIVE_REGENERATION => true,
                PropertyCode::REQUIRES_DM_AGREEMENT => false,
                PropertyCode::AGE => 12,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_wild_kroll_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getWildKrollModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => 3,
                PropertyCode::AGILITY => -1,
                PropertyCode::KNACK => -2,
                PropertyCode::WILL => 2,
                PropertyCode::INTELLIGENCE => -3,
                PropertyCode::CHARISMA => -2,
                PropertyCode::TOUGHNESS => 0,
                PropertyCode::HEIGHT_IN_CM => 220.0,
                PropertyCode::WEIGHT_IN_KG => 120.0,
                PropertyCode::SIZE => 3,
                PropertyCode::SENSES => 0,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::HEARING,
                PropertyCode::INFRAVISION => false,
                PropertyCode::NATIVE_REGENERATION => true,
                PropertyCode::REQUIRES_DM_AGREEMENT => true,
                PropertyCode::AGE => 11,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_common_orc_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getCommonOrcModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => 0,
                PropertyCode::AGILITY => 2,
                PropertyCode::KNACK => 0,
                PropertyCode::WILL => -1,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => -2,
                PropertyCode::TOUGHNESS => 0,
                PropertyCode::HEIGHT_IN_CM => 160.0,
                PropertyCode::WEIGHT_IN_KG => 60.0,
                PropertyCode::SIZE => -1,
                PropertyCode::SENSES => 1,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::SMELL,
                PropertyCode::INFRAVISION => true,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => true,
                PropertyCode::AGE => 10,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_skurut_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getSkurutModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => 1,
                PropertyCode::AGILITY => 1,
                PropertyCode::KNACK => -1,
                PropertyCode::WILL => 0,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => -2,
                PropertyCode::TOUGHNESS => 0,
                PropertyCode::HEIGHT_IN_CM => 180.0,
                PropertyCode::WEIGHT_IN_KG => 90.0,
                PropertyCode::SIZE => 1,
                PropertyCode::SENSES => 1,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::SMELL,
                PropertyCode::INFRAVISION => true,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => true,
                PropertyCode::AGE => 13,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_goblin_modifiers()
    {
        $racesTable = new RacesTable();
        $modifiers = $racesTable->getGoblinModifiers();
        self::assertEquals(
            [
                PropertyCode::STRENGTH => -1,
                PropertyCode::AGILITY => 2,
                PropertyCode::KNACK => 1,
                PropertyCode::WILL => -2,
                PropertyCode::INTELLIGENCE => 0,
                PropertyCode::CHARISMA => -1,
                PropertyCode::TOUGHNESS => 0,
                PropertyCode::HEIGHT_IN_CM => 150.0,
                PropertyCode::WEIGHT_IN_KG => 55.0,
                PropertyCode::SIZE => -1,
                PropertyCode::SENSES => 1,
                PropertyCode::REMARKABLE_SENSE => PropertyCode::SMELL,
                PropertyCode::INFRAVISION => true,
                PropertyCode::NATIVE_REGENERATION => false,
                PropertyCode::REQUIRES_DM_AGREEMENT => true,
                PropertyCode::AGE => 9,
            ],
            $modifiers
        );
    }

    /**
     * @test
     */
    public function I_can_get_expected_values()
    {
        $racesTable = new RacesTable();
        self::assertEquals(
            [
                RaceCode::HUMAN => [
                    SubRaceCode::COMMON => [
                        PropertyCode::STRENGTH => 0, PropertyCode::AGILITY => 0, PropertyCode::KNACK => 0, PropertyCode::WILL => 0,
                        PropertyCode::INTELLIGENCE => 0, PropertyCode::CHARISMA => 0, PropertyCode::TOUGHNESS => 0,
                        PropertyCode::HEIGHT_IN_CM => 180.0, PropertyCode::WEIGHT_IN_KG => 80.0, PropertyCode::SIZE => 0,
                        PropertyCode::SENSES => 0, PropertyCode::REMARKABLE_SENSE => '',
                        PropertyCode::INFRAVISION => false, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => false,
                        PropertyCode::AGE => 15,
                    ],
                    SubRaceCode::HIGHLANDER => [PropertyCode::STRENGTH => 1, PropertyCode::AGILITY => 0, PropertyCode::KNACK => 0,
                        PropertyCode::WILL => 1, PropertyCode::INTELLIGENCE => -1, PropertyCode::CHARISMA => -1,
                        PropertyCode::TOUGHNESS => 0,
                        PropertyCode::HEIGHT_IN_CM => 180.0, PropertyCode::WEIGHT_IN_KG => 80.0, PropertyCode::SIZE => 0,
                        PropertyCode::SENSES => 0, PropertyCode::REMARKABLE_SENSE => '',
                        PropertyCode::INFRAVISION => false, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => false,
                        PropertyCode::AGE => 14,
                    ],
                ],
                RaceCode::ELF => [
                    SubRaceCode::COMMON => [
                        PropertyCode::STRENGTH => -1, PropertyCode::AGILITY => 1, PropertyCode::KNACK => 1,
                        PropertyCode::WILL => -2, PropertyCode::INTELLIGENCE => 1, PropertyCode::CHARISMA => 1,
                        PropertyCode::TOUGHNESS => -1,
                        PropertyCode::HEIGHT_IN_CM => 160.0, PropertyCode::WEIGHT_IN_KG => 50.0, PropertyCode::SIZE => -1,
                        PropertyCode::SENSES => 0, PropertyCode::REMARKABLE_SENSE => PropertyCode::SIGHT,
                        PropertyCode::INFRAVISION => false, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => false,
                        PropertyCode::AGE => 32,
                    ],
                    SubRaceCode::GREEN => [
                        PropertyCode::STRENGTH => -1, PropertyCode::AGILITY => 1, PropertyCode::KNACK => 0,
                        PropertyCode::WILL => -1, PropertyCode::INTELLIGENCE => 1, PropertyCode::CHARISMA => 1,
                        PropertyCode::TOUGHNESS => -1,
                        PropertyCode::HEIGHT_IN_CM => 160.0, PropertyCode::WEIGHT_IN_KG => 50.0, PropertyCode::SIZE => -1,
                        PropertyCode::SENSES => 0, PropertyCode::REMARKABLE_SENSE => PropertyCode::SIGHT,
                        PropertyCode::INFRAVISION => false, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => false,
                        PropertyCode::AGE => 30,
                    ],
                    SubRaceCode::DARK => [
                        PropertyCode::STRENGTH => 0, PropertyCode::AGILITY => 0, PropertyCode::KNACK => 0,
                        PropertyCode::WILL => 0, PropertyCode::INTELLIGENCE => 1, PropertyCode::CHARISMA => 0,
                        PropertyCode::TOUGHNESS => -1,
                        PropertyCode::HEIGHT_IN_CM => 160.0, PropertyCode::WEIGHT_IN_KG => 50.0, PropertyCode::SIZE => -1,
                        PropertyCode::SENSES => 0, PropertyCode::REMARKABLE_SENSE => PropertyCode::SIGHT,
                        PropertyCode::INFRAVISION => true, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => true,
                        PropertyCode::AGE => 30,
                    ],
                ],
                RaceCode::DWARF => [
                    SubRaceCode::COMMON => [
                        PropertyCode::STRENGTH => 1, PropertyCode::AGILITY => -1, PropertyCode::KNACK => 0, PropertyCode::WILL => 2,
                        PropertyCode::INTELLIGENCE => -1, PropertyCode::CHARISMA => -2, PropertyCode::TOUGHNESS => 1,
                        PropertyCode::HEIGHT_IN_CM => 140.0, PropertyCode::WEIGHT_IN_KG => 70.0, PropertyCode::SIZE => 0,
                        PropertyCode::SENSES => -1, PropertyCode::REMARKABLE_SENSE => PropertyCode::TOUCH,
                        PropertyCode::INFRAVISION => true, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => false,
                        PropertyCode::AGE => 22,
                    ],
                    SubRaceCode::WOOD => [
                        PropertyCode::STRENGTH => 1, PropertyCode::AGILITY => -1, PropertyCode::KNACK => 0, PropertyCode::WILL => 1,
                        PropertyCode::INTELLIGENCE => -1, PropertyCode::CHARISMA => -1, PropertyCode::TOUGHNESS => 1,
                        PropertyCode::HEIGHT_IN_CM => 140.0, PropertyCode::WEIGHT_IN_KG => 70.0, PropertyCode::SIZE => 0,
                        PropertyCode::SENSES => -1, PropertyCode::REMARKABLE_SENSE => PropertyCode::TOUCH,
                        PropertyCode::INFRAVISION => true, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => false,
                        PropertyCode::AGE => 20,
                    ],
                    SubRaceCode::MOUNTAIN => [
                        PropertyCode::STRENGTH => 2, PropertyCode::AGILITY => -1, PropertyCode::KNACK => 0, PropertyCode::WILL => 2,
                        PropertyCode::INTELLIGENCE => -2, PropertyCode::CHARISMA => -2, PropertyCode::TOUGHNESS => 1,
                        PropertyCode::HEIGHT_IN_CM => 140.0, PropertyCode::WEIGHT_IN_KG => 70.0, PropertyCode::SIZE => 0,
                        PropertyCode::SENSES => -1, PropertyCode::REMARKABLE_SENSE => PropertyCode::TOUCH,
                        PropertyCode::INFRAVISION => true, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => false,
                        PropertyCode::AGE => 18,
                    ],
                ],
                RaceCode::HOBBIT => [
                    SubRaceCode::COMMON => [
                        PropertyCode::STRENGTH => -3, PropertyCode::AGILITY => 1, PropertyCode::KNACK => 1, PropertyCode::WILL => 0,
                        PropertyCode::INTELLIGENCE => -1, PropertyCode::CHARISMA => 2, PropertyCode::TOUGHNESS => 0,
                        PropertyCode::HEIGHT_IN_CM => 110.0, PropertyCode::WEIGHT_IN_KG => 40.0, PropertyCode::SIZE => -2,
                        PropertyCode::SENSES => 0, PropertyCode::REMARKABLE_SENSE => PropertyCode::TASTE,
                        PropertyCode::INFRAVISION => false, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => false,
                        PropertyCode::AGE => 25,
                    ],
                ],
                RaceCode::KROLL => [
                    SubRaceCode::COMMON => [
                        PropertyCode::STRENGTH => 3, PropertyCode::AGILITY => -2, PropertyCode::KNACK => -1, PropertyCode::WILL => 1,
                        PropertyCode::INTELLIGENCE => -3, PropertyCode::CHARISMA => -1, PropertyCode::TOUGHNESS => 0,
                        PropertyCode::HEIGHT_IN_CM => 220.0, PropertyCode::WEIGHT_IN_KG => 120.0, PropertyCode::SIZE => 3,
                        PropertyCode::SENSES => 0, PropertyCode::REMARKABLE_SENSE => PropertyCode::HEARING,
                        PropertyCode::INFRAVISION => false, PropertyCode::NATIVE_REGENERATION => true,
                        PropertyCode::REQUIRES_DM_AGREEMENT => false,
                        PropertyCode::AGE => 12,
                    ],
                    SubRaceCode::WILD => [
                        PropertyCode::STRENGTH => 3, PropertyCode::AGILITY => -1, PropertyCode::KNACK => -2, PropertyCode::WILL => 2,
                        PropertyCode::INTELLIGENCE => -3, PropertyCode::CHARISMA => -2, PropertyCode::TOUGHNESS => 0,
                        PropertyCode::HEIGHT_IN_CM => 220.0, PropertyCode::WEIGHT_IN_KG => 120.0, PropertyCode::SIZE => 3,
                        PropertyCode::SENSES => 0, PropertyCode::REMARKABLE_SENSE => PropertyCode::HEARING,
                        PropertyCode::INFRAVISION => false, PropertyCode::NATIVE_REGENERATION => true,
                        PropertyCode::REQUIRES_DM_AGREEMENT => true,
                        PropertyCode::AGE => 11,
                    ],
                ],
                RaceCode::ORC => [
                    SubRaceCode::COMMON => [
                        PropertyCode::STRENGTH => 0, PropertyCode::AGILITY => 2, PropertyCode::KNACK => 0, PropertyCode::WILL => -1,
                        PropertyCode::INTELLIGENCE => 0, PropertyCode::CHARISMA => -2, PropertyCode::TOUGHNESS => 0,
                        PropertyCode::HEIGHT_IN_CM => 160.0, PropertyCode::WEIGHT_IN_KG => 60.0, PropertyCode::SIZE => -1,
                        PropertyCode::SENSES => 1, PropertyCode::REMARKABLE_SENSE => PropertyCode::SMELL,
                        PropertyCode::INFRAVISION => true, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => true,
                        PropertyCode::AGE => 10,
                    ],
                    SubRaceCode::SKURUT => [
                        PropertyCode::STRENGTH => 1, PropertyCode::AGILITY => 1, PropertyCode::KNACK => -1, PropertyCode::WILL => 0,
                        PropertyCode::INTELLIGENCE => 0, PropertyCode::CHARISMA => -2, PropertyCode::TOUGHNESS => 0,
                        PropertyCode::HEIGHT_IN_CM => 180.0, PropertyCode::WEIGHT_IN_KG => 90.0, PropertyCode::SIZE => 1,
                        PropertyCode::SENSES => 1, PropertyCode::REMARKABLE_SENSE => PropertyCode::SMELL,
                        PropertyCode::INFRAVISION => true, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => true,
                        PropertyCode::AGE => 13,
                    ],
                    SubRaceCode::GOBLIN => [
                        PropertyCode::STRENGTH => -1, PropertyCode::AGILITY => 2, PropertyCode::KNACK => 1, PropertyCode::WILL => -2,
                        PropertyCode::INTELLIGENCE => 0, PropertyCode::CHARISMA => -1, PropertyCode::TOUGHNESS => 0,
                        PropertyCode::HEIGHT_IN_CM => 150.0, PropertyCode::WEIGHT_IN_KG => 55.0, PropertyCode::SIZE => -1,
                        PropertyCode::SENSES => 1, PropertyCode::REMARKABLE_SENSE => PropertyCode::SMELL,
                        PropertyCode::INFRAVISION => true, PropertyCode::NATIVE_REGENERATION => false,
                        PropertyCode::REQUIRES_DM_AGREEMENT => true,
                        PropertyCode::AGE => 9,
                    ],
                ],
            ],
            $racesTable->getIndexedValues()
        );
    }

    /**
     * @test
     * @dataProvider provideStrengthOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $maleStrength
     * @param int $femaleStrength
     */
    public function I_can_get_strength_of_any_race($race, $subrace, $maleStrength, $femaleStrength)
    {
        $racesTable = new RacesTable();
        self::assertSame($maleStrength, $racesTable->getMaleStrength(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
        self::assertSame(
            $femaleStrength,
            $racesTable->getFemaleStrength(RaceCode::getIt($race), SubRaceCode::getIt($subrace), new FemaleModifiersTable())
        );
    }

    public function provideStrengthOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 0, -1],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, 1, 0],
            [RaceCode::ELF, SubRaceCode::COMMON, -1, -2],
            [RaceCode::ELF, SubRaceCode::GREEN, -1, -2],
            [RaceCode::ELF, SubRaceCode::DARK, 0, -1],
            [RaceCode::DWARF, SubRaceCode::COMMON, 1, 1],
            [RaceCode::DWARF, SubRaceCode::WOOD, 1, 1],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, 2, 2],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, -3, -4],
            [RaceCode::KROLL, SubRaceCode::COMMON, 3, 2],
            [RaceCode::KROLL, SubRaceCode::WILD, 3, 2],
            [RaceCode::ORC, SubRaceCode::COMMON, 0, -1],
            [RaceCode::ORC, SubRaceCode::SKURUT, 1, 0],
            [RaceCode::ORC, SubRaceCode::GOBLIN, -1, -2],
        ];
    }

    /**
     * @test
     * @dataProvider provideAgilityOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $maleAgility
     * @param int $femaleAgility
     */
    public function I_can_get_agility_of_any_race($race, $subrace, $maleAgility, $femaleAgility)
    {
        $racesTable = new RacesTable();
        self::assertSame($maleAgility, $racesTable->getMaleAgility(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
        self::assertSame(
            $femaleAgility,
            $racesTable->getFemaleAgility(RaceCode::getIt($race), SubRaceCode::getIt($subrace), new FemaleModifiersTable())
        );
    }

    public function provideAgilityOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 0, 0],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, 0, 0],
            [RaceCode::ELF, SubRaceCode::COMMON, 1, 1],
            [RaceCode::ELF, SubRaceCode::GREEN, 1, 1],
            [RaceCode::ELF, SubRaceCode::DARK, 0, 0],
            [RaceCode::DWARF, SubRaceCode::COMMON, -1, -1],
            [RaceCode::DWARF, SubRaceCode::WOOD, -1, -1],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, -1, -1],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, 1, 2],
            [RaceCode::KROLL, SubRaceCode::COMMON, -2, -1],
            [RaceCode::KROLL, SubRaceCode::WILD, -1, 0],
            [RaceCode::ORC, SubRaceCode::COMMON, 2, 2],
            [RaceCode::ORC, SubRaceCode::SKURUT, 1, 1],
            [RaceCode::ORC, SubRaceCode::GOBLIN, 2, 2],
        ];
    }

    /**
     * @test
     * @dataProvider provideKnackOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $maleKnack
     * @param int $femaleKnack
     */
    public function I_can_get_knack_of_any_race($race, $subrace, $maleKnack, $femaleKnack)
    {
        $racesTable = new RacesTable();
        self::assertSame($maleKnack, $racesTable->getMaleKnack(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
        self::assertSame($femaleKnack, $racesTable->getFemaleKnack(RaceCode::getIt($race), SubRaceCode::getIt($subrace), new FemaleModifiersTable()));
    }

    public function provideKnackOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 0, 0],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, 0, 0],
            [RaceCode::ELF, SubRaceCode::COMMON, 1, 2],
            [RaceCode::ELF, SubRaceCode::GREEN, 0, 1],
            [RaceCode::ELF, SubRaceCode::DARK, 0, 1],
            [RaceCode::DWARF, SubRaceCode::COMMON, 0, -1],
            [RaceCode::DWARF, SubRaceCode::WOOD, 0, -1],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, 0, -1],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, 1, 0],
            [RaceCode::KROLL, SubRaceCode::COMMON, -1, -1],
            [RaceCode::KROLL, SubRaceCode::WILD, -2, -2],
            [RaceCode::ORC, SubRaceCode::COMMON, 0, 0],
            [RaceCode::ORC, SubRaceCode::SKURUT, -1, -1],
            [RaceCode::ORC, SubRaceCode::GOBLIN, 1, 1],
        ];
    }

    /**
     * @test
     * @dataProvider provideWillOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $maleWill
     * @param int $femaleWill
     */
    public function I_can_get_will_of_any_race($race, $subrace, $maleWill, $femaleWill)
    {
        $racesTable = new RacesTable();
        self::assertSame($maleWill, $racesTable->getMaleWill(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
        self::assertSame($femaleWill, $racesTable->getFemaleWill(RaceCode::getIt($race), SubRaceCode::getIt($subrace), new FemaleModifiersTable()));
    }

    public function provideWillOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 0, 0],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, 1, 1],
            [RaceCode::ELF, SubRaceCode::COMMON, -2, -2],
            [RaceCode::ELF, SubRaceCode::GREEN, -1, -1],
            [RaceCode::ELF, SubRaceCode::DARK, 0, 0],
            [RaceCode::DWARF, SubRaceCode::COMMON, 2, 2],
            [RaceCode::DWARF, SubRaceCode::WOOD, 1, 1],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, 2, 2],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, 0, 0],
            [RaceCode::KROLL, SubRaceCode::COMMON, 1, 0],
            [RaceCode::KROLL, SubRaceCode::WILD, 2, 1],
            [RaceCode::ORC, SubRaceCode::COMMON, -1, 0],
            [RaceCode::ORC, SubRaceCode::SKURUT, 0, 1],
            [RaceCode::ORC, SubRaceCode::GOBLIN, -2, -1],
        ];
    }

    /**
     * @test
     * @dataProvider provideIntelligenceOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $maleIntelligence
     * @param int $femaleIntelligence
     */
    public function I_can_get_intelligence_of_any_race($race, $subrace, $maleIntelligence, $femaleIntelligence)
    {
        $racesTable = new RacesTable();
        self::assertSame($maleIntelligence, $racesTable->getMaleIntelligence(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
        self::assertSame($femaleIntelligence, $racesTable->getFemaleIntelligence(RaceCode::getIt($race), SubRaceCode::getIt($subrace), new FemaleModifiersTable()));
    }

    public function provideIntelligenceOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 0, 0],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, -1, -1],
            [RaceCode::ELF, SubRaceCode::COMMON, 1, 0],
            [RaceCode::ELF, SubRaceCode::GREEN, 1, 0],
            [RaceCode::ELF, SubRaceCode::DARK, 1, 0],
            [RaceCode::DWARF, SubRaceCode::COMMON, -1, 0],
            [RaceCode::DWARF, SubRaceCode::WOOD, -1, 0],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, -2, -1],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, -1, -1],
            [RaceCode::KROLL, SubRaceCode::COMMON, -3, -3],
            [RaceCode::KROLL, SubRaceCode::WILD, -3, -3],
            [RaceCode::ORC, SubRaceCode::COMMON, 0, 0],
            [RaceCode::ORC, SubRaceCode::SKURUT, 0, 0],
            [RaceCode::ORC, SubRaceCode::GOBLIN, 0, 0],
        ];
    }

    /**
     * @test
     * @dataProvider provideCharismaOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $maleCharisma
     * @param int $femaleCharisma
     */
    public function I_can_get_charisma_of_any_race($race, $subrace, $maleCharisma, $femaleCharisma)
    {
        $racesTable = new RacesTable();
        self::assertSame($maleCharisma, $racesTable->getMaleCharisma(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
        self::assertSame($femaleCharisma, $racesTable->getFemaleCharisma(RaceCode::getIt($race), SubRaceCode::getIt($subrace), new FemaleModifiersTable()));
    }

    public function provideCharismaOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 0, 1],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, -1, 0],
            [RaceCode::ELF, SubRaceCode::COMMON, 1, 2],
            [RaceCode::ELF, SubRaceCode::GREEN, 1, 2],
            [RaceCode::ELF, SubRaceCode::DARK, 0, 1],
            [RaceCode::DWARF, SubRaceCode::COMMON, -2, -2],
            [RaceCode::DWARF, SubRaceCode::WOOD, -1, -1],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, -2, -2],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, 2, 3],
            [RaceCode::KROLL, SubRaceCode::COMMON, -1, 0],
            [RaceCode::KROLL, SubRaceCode::WILD, -2, -1],
            [RaceCode::ORC, SubRaceCode::COMMON, -2, -2],
            [RaceCode::ORC, SubRaceCode::SKURUT, -2, -2],
            [RaceCode::ORC, SubRaceCode::GOBLIN, -1, -1],
        ];
    }

    /**
     * @test
     * @dataProvider provideToughnessOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $toughness
     */
    public function I_can_get_toughness_of_any_race($race, $subrace, $toughness)
    {
        $racesTable = new RacesTable();
        self::assertSame($toughness, $racesTable->getToughness(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
    }

    public function provideToughnessOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 0],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, 0],
            [RaceCode::ELF, SubRaceCode::COMMON, -1],
            [RaceCode::ELF, SubRaceCode::GREEN, -1],
            [RaceCode::ELF, SubRaceCode::DARK, -1],
            [RaceCode::DWARF, SubRaceCode::COMMON, 1],
            [RaceCode::DWARF, SubRaceCode::WOOD, 1],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, 1],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, 0],
            [RaceCode::KROLL, SubRaceCode::COMMON, 0],
            [RaceCode::KROLL, SubRaceCode::WILD, 0],
            [RaceCode::ORC, SubRaceCode::COMMON, 0],
            [RaceCode::ORC, SubRaceCode::SKURUT, 0],
            [RaceCode::ORC, SubRaceCode::GOBLIN, 0],
        ];
    }

    /**
     * @test
     * @dataProvider provideHeightOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $heightInCm
     */
    public function I_can_get_height_of_any_race($race, $subrace, $heightInCm)
    {
        $racesTable = new RacesTable();
        self::assertSame($heightInCm, $racesTable->getHeightInCm(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
    }

    public function provideHeightOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 180.0],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, 180.0],
            [RaceCode::ELF, SubRaceCode::COMMON, 160.0],
            [RaceCode::ELF, SubRaceCode::GREEN, 160.0],
            [RaceCode::ELF, SubRaceCode::DARK, 160.0],
            [RaceCode::DWARF, SubRaceCode::COMMON, 140.0],
            [RaceCode::DWARF, SubRaceCode::WOOD, 140.0],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, 140.0],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, 110.0],
            [RaceCode::KROLL, SubRaceCode::COMMON, 220.0],
            [RaceCode::KROLL, SubRaceCode::WILD, 220.0],
            [RaceCode::ORC, SubRaceCode::COMMON, 160.0],
            [RaceCode::ORC, SubRaceCode::SKURUT, 180.0],
            [RaceCode::ORC, SubRaceCode::GOBLIN, 150.0],
        ];
    }

    /**
     * @test
     * @dataProvider provideWeightOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $maleWeightInKg
     * @param int $femaleWeightInKg
     */
    public function I_can_get_weight_of_any_race($race, $subrace, $maleWeightInKg, $femaleWeightInKg)
    {
        $racesTable = new RacesTable();
        self::assertSame($maleWeightInKg, $racesTable->getMaleWeightInKg(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
        $femaleModifiersTable = new FemaleModifiersTable();
        $weightTable = new WeightTable();
        self::assertSame(
            $femaleWeightInKg,
            $racesTable->getFemaleWeightInKg(RaceCode::getIt($race), SubRaceCode::getIt($subrace), $femaleModifiersTable, $weightTable)
        );
        self::assertSame(
            $maleWeightInKg,
            $racesTable->getWeightInKg(RaceCode::getIt($race), SubRaceCode::getIt($subrace), GenderCode::getIt(GenderCode::MALE), $femaleModifiersTable, $weightTable)
        );
        self::assertSame(
            $femaleWeightInKg,
            $racesTable->getWeightInKg(RaceCode::getIt($race), SubRaceCode::getIt($subrace), GenderCode::getIt(GenderCode::FEMALE), $femaleModifiersTable, $weightTable)
        );
    }

    public function provideWeightOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 80.0, 70.0],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, 80.0, 70.0],
            [RaceCode::ELF, SubRaceCode::COMMON, 50.0, 45.0],
            [RaceCode::ELF, SubRaceCode::GREEN, 50.0, 45.0],
            [RaceCode::ELF, SubRaceCode::DARK, 50.0, 45.0],
            [RaceCode::DWARF, SubRaceCode::COMMON, 70.0, 70.0],
            [RaceCode::DWARF, SubRaceCode::WOOD, 70.0, 70.0],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, 70.0, 70.0],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, 40.0, 36.0],
            [RaceCode::KROLL, SubRaceCode::COMMON, 120.0, 110.0],
            [RaceCode::KROLL, SubRaceCode::WILD, 120.0, 110.0],
            [RaceCode::ORC, SubRaceCode::COMMON, 60.0, 56.0],
            [RaceCode::ORC, SubRaceCode::SKURUT, 90.0, 80.0],
            [RaceCode::ORC, SubRaceCode::GOBLIN, 55.0, 50.0],
        ];
    }

    /**
     * @test
     * @expectedException \DrdPlus\Tables\Races\Exceptions\UnknownGender
     */
    public function I_can_not_get_weight_of_unknown_gender()
    {
        $racesTable = new RacesTable();
        $racesTable->getWeightInKg(
            RaceCode::getIt(RaceCode::HUMAN),
            SubRaceCode::getIt(SubRaceCode::COMMON),
            $this->createGenderCode('not from this universe'),
            new FemaleModifiersTable(),
            new WeightTable()
        );
    }

    /**
     * @param $value
     * @return \Mockery\MockInterface|GenderCode
     */
    private function createGenderCode($value)
    {
        $genderCode = $this->mockery(GenderCode::class);
        $genderCode->shouldReceive('getValue')
            ->andReturn($value);

        return $genderCode;
    }

    /**
     * @test
     * @dataProvider provideSizeOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $maleSize
     * @param int $femaleSize
     */
    public function I_can_get_size_of_any_race($race, $subrace, $maleSize, $femaleSize)
    {
        $racesTable = new RacesTable();
        $femaleModifiersTable = new FemaleModifiersTable();

        self::assertSame($maleSize, $racesTable->getMaleSize(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
        self::assertSame($maleSize, $racesTable->getSize(RaceCode::getIt($race), SubRaceCode::getIt($subrace), GenderCode::getIt(GenderCode::MALE), $femaleModifiersTable));

        self::assertSame($femaleSize, $racesTable->getFemaleSize(RaceCode::getIt($race), SubRaceCode::getIt($subrace), $femaleModifiersTable));
        self::assertSame($femaleSize, $racesTable->getSize(RaceCode::getIt($race), SubRaceCode::getIt($subrace), GenderCode::getIt(GenderCode::FEMALE), $femaleModifiersTable));
    }

    public function provideSizeOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 0, -1],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, 0, -1],
            [RaceCode::ELF, SubRaceCode::COMMON, -1, -2],
            [RaceCode::ELF, SubRaceCode::GREEN, -1, -2],
            [RaceCode::ELF, SubRaceCode::DARK, -1, -2],
            [RaceCode::DWARF, SubRaceCode::COMMON, 0, 0],
            [RaceCode::DWARF, SubRaceCode::WOOD, 0, 0],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, 0, 0],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, -2, -3],
            [RaceCode::KROLL, SubRaceCode::COMMON, 3, 2],
            [RaceCode::KROLL, SubRaceCode::WILD, 3, 2],
            [RaceCode::ORC, SubRaceCode::COMMON, -1, -2],
            [RaceCode::ORC, SubRaceCode::SKURUT, 1, 0],
            [RaceCode::ORC, SubRaceCode::GOBLIN, -1, -2],
        ];
    }

    /**
     * @test
     * @expectedException \DrdPlus\Tables\Races\Exceptions\UnknownGender
     */
    public function I_can_not_get_size_for_unknown_gender()
    {
        $racesTable = new RacesTable();
        $racesTable->getSize(
            RaceCode::getIt(RaceCode::HUMAN),
            SubRaceCode::getIt(SubRaceCode::COMMON),
            $this->createGenderCode('unknown gender'),
            new FemaleModifiersTable()
        );
    }

    /**
     * @test
     * @dataProvider provideSensesOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param int $senses
     */
    public function I_can_get_senses_of_any_race($race, $subrace, $senses)
    {
        $racesTable = new RacesTable();
        self::assertSame($senses, $racesTable->getSenses(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
    }

    public function provideSensesOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, 0],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, 0],
            [RaceCode::ELF, SubRaceCode::COMMON, 0],
            [RaceCode::ELF, SubRaceCode::GREEN, 0],
            [RaceCode::ELF, SubRaceCode::DARK, 0],
            [RaceCode::DWARF, SubRaceCode::COMMON, -1],
            [RaceCode::DWARF, SubRaceCode::WOOD, -1],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, -1],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, 0],
            [RaceCode::KROLL, SubRaceCode::COMMON, 0],
            [RaceCode::KROLL, SubRaceCode::WILD, 0],
            [RaceCode::ORC, SubRaceCode::COMMON, 1],
            [RaceCode::ORC, SubRaceCode::SKURUT, 1],
            [RaceCode::ORC, SubRaceCode::GOBLIN, 1],
        ];
    }

    /**
     * @test
     * @dataProvider provideRemarkableSenseOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param string $remarkableSense
     */
    public function I_can_get_remarkable_sense_of_any_race($race, $subrace, $remarkableSense)
    {
        $racesTable = new RacesTable();
        self::assertSame($remarkableSense, $racesTable->getRemarkableSense(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
    }

    public function provideRemarkableSenseOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, ''],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, ''],
            [RaceCode::ELF, SubRaceCode::COMMON, PropertyCode::SIGHT],
            [RaceCode::ELF, SubRaceCode::GREEN, PropertyCode::SIGHT],
            [RaceCode::ELF, SubRaceCode::DARK, PropertyCode::SIGHT],
            [RaceCode::DWARF, SubRaceCode::COMMON, PropertyCode::TOUCH],
            [RaceCode::DWARF, SubRaceCode::WOOD, PropertyCode::TOUCH],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, PropertyCode::TOUCH],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, PropertyCode::TASTE],
            [RaceCode::KROLL, SubRaceCode::COMMON, PropertyCode::HEARING],
            [RaceCode::KROLL, SubRaceCode::WILD, PropertyCode::HEARING],
            [RaceCode::ORC, SubRaceCode::COMMON, PropertyCode::SMELL],
            [RaceCode::ORC, SubRaceCode::SKURUT, PropertyCode::SMELL],
            [RaceCode::ORC, SubRaceCode::GOBLIN, PropertyCode::SMELL],
        ];
    }

    /**
     * @test
     * @dataProvider provideInfravisionOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param bool $infravision
     */
    public function I_can_get_infravision_of_any_race($race, $subrace, $infravision)
    {
        $racesTable = new RacesTable();
        self::assertSame($infravision, $racesTable->hasInfravision(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
    }

    public function provideInfravisionOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, false],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, false],
            [RaceCode::ELF, SubRaceCode::COMMON, false],
            [RaceCode::ELF, SubRaceCode::GREEN, false],
            [RaceCode::ELF, SubRaceCode::DARK, true],
            [RaceCode::DWARF, SubRaceCode::COMMON, true],
            [RaceCode::DWARF, SubRaceCode::WOOD, true],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, true],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, false],
            [RaceCode::KROLL, SubRaceCode::COMMON, false],
            [RaceCode::KROLL, SubRaceCode::WILD, false],
            [RaceCode::ORC, SubRaceCode::COMMON, true],
            [RaceCode::ORC, SubRaceCode::SKURUT, true],
            [RaceCode::ORC, SubRaceCode::GOBLIN, true],
        ];
    }

    /**
     * @test
     * @dataProvider provideNativeRegenerationOfRace
     *
     * @param string $race
     * @param string $subrace
     * @param bool $nativeRegeneration
     */
    public function I_can_get_nativeRegeneration_of_any_race($race, $subrace, $nativeRegeneration)
    {
        $racesTable = new RacesTable();
        self::assertSame($nativeRegeneration, $racesTable->hasNativeRegeneration(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
    }

    public function provideNativeRegenerationOfRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, false],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, false],
            [RaceCode::ELF, SubRaceCode::COMMON, false],
            [RaceCode::ELF, SubRaceCode::GREEN, false],
            [RaceCode::ELF, SubRaceCode::DARK, false],
            [RaceCode::DWARF, SubRaceCode::COMMON, false],
            [RaceCode::DWARF, SubRaceCode::WOOD, false],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, false],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, false],
            [RaceCode::KROLL, SubRaceCode::COMMON, true],
            [RaceCode::KROLL, SubRaceCode::WILD, true],
            [RaceCode::ORC, SubRaceCode::COMMON, false],
            [RaceCode::ORC, SubRaceCode::SKURUT, false],
            [RaceCode::ORC, SubRaceCode::GOBLIN, false],
        ];
    }

    /**
     * @test
     * @dataProvider provideRequirementOfDmForRace
     *
     * @param string $race
     * @param string $subrace
     * @param bool $requiredDmAgreement
     */
    public function I_can_detect_requirement_of_dm_agreement_of_any_race($race, $subrace, $requiredDmAgreement)
    {
        $racesTable = new RacesTable();
        self::assertSame($requiredDmAgreement, $racesTable->requiresDmAgreement(RaceCode::getIt($race), SubRaceCode::getIt($subrace)));
    }

    public function provideRequirementOfDmForRace()
    {
        return [
            [RaceCode::HUMAN, SubRaceCode::COMMON, false],
            [RaceCode::HUMAN, SubRaceCode::HIGHLANDER, false],
            [RaceCode::ELF, SubRaceCode::COMMON, false],
            [RaceCode::ELF, SubRaceCode::GREEN, false],
            [RaceCode::ELF, SubRaceCode::DARK, true],
            [RaceCode::DWARF, SubRaceCode::COMMON, false],
            [RaceCode::DWARF, SubRaceCode::WOOD, false],
            [RaceCode::DWARF, SubRaceCode::MOUNTAIN, false],
            [RaceCode::HOBBIT, SubRaceCode::COMMON, false],
            [RaceCode::KROLL, SubRaceCode::COMMON, false],
            [RaceCode::KROLL, SubRaceCode::WILD, true],
            [RaceCode::ORC, SubRaceCode::COMMON, true],
            [RaceCode::ORC, SubRaceCode::SKURUT, true],
            [RaceCode::ORC, SubRaceCode::GOBLIN, true],
        ];
    }
}