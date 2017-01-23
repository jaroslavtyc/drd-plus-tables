<?php
namespace DrdPlus\Tables\History;

use DrdPlus\Codes\History\FateCode;
use DrdPlus\Tables\Partials\AbstractFileTable;
use DrdPlus\Tables\Partials\Exceptions\RequiredRowNotFound;

/**
 * See PPH page 37 right column, @link https://pph.drdplus.jaroslavtyc.com/#tabulka_bodu_zazemi
 */
class BackgroundPointsTable extends AbstractFileTable
{
    /**
     * @return string
     */
    protected function getDataFileName()
    {
        return __DIR__ . '/data/background_points.csv';
    }

    const BACKGROUND_POINTS = 'background_points';

    /**
     * @return array|string[]
     */
    protected function getExpectedDataHeaderNamesToTypes()
    {
        return [
            self::BACKGROUND_POINTS => self::POSITIVE_INTEGER,
        ];
    }

    /**
     * @return array|string[]
     */
    protected function getRowsHeader()
    {
        return [
            PlayerDecisionsTable::FATE,
        ];
    }

    /**
     * @param FateCode $fateCode
     * @return int
     * @throws \DrdPlus\Tables\History\Exceptions\UnknownFate
     */
    public function getBackgroundPointsByPlayerDecision(FateCode $fateCode)
    {
        try {
            /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
            return $this->getValue($fateCode, self::BACKGROUND_POINTS);
        } catch (RequiredRowNotFound $requiredRowNotFound) {
            throw new Exceptions\UnknownFate('Unknown fate ' . $fateCode->getValue());
        }
    }

}