<?php
namespace DrdPlus\Tables\Armaments\Shields;

use DrdPlus\Tables\Armaments\Partials\AbstractMissingArmamentSkillsTable;
use Granam\Integer\IntegerInterface;

class MissingShieldSkillsTable extends AbstractMissingArmamentSkillsTable
{
    protected function getDataFileName()
    {
        return __DIR__ . '/data/missing_shield_skills.csv';
    }

    const RESTRICTION_BONUS = 'restriction_bonus';
    const COVER = 'cover';

    /**
     * @return array|string[]
     */
    protected function getExpectedDataHeaderNamesToTypes()
    {
        return [
            self::RESTRICTION_BONUS => self::POSITIVE_INTEGER,
            self::COVER => self::NEGATIVE_INTEGER
        ];
    }

    /**
     * @param int|IntegerInterface $skillRank
     * @return int
     */
    public function getRestrictionBonusForSkillRank($skillRank)
    {
        return $this->getValueForSkillRank($skillRank, self::RESTRICTION_BONUS);
    }

    /**
     * @param int|IntegerInterface $skillRank
     * @return int
     */
    public function getCoverForSkillRank($skillRank)
    {
        return $this->getValueForSkillRank($skillRank, self::RESTRICTION_BONUS);
    }

}