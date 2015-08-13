<?php
namespace DrdPlus\Tables;

use DrdPlus\Tables\Base\Amount\AmountTable;
use DrdPlus\Tables\BaseOfWounds\BaseOfWoundsTable;
use DrdPlus\Tables\Base\Distance\DistanceTable;
use DrdPlus\Tables\Derived\Experiences\ExperiencesTable;
use DrdPlus\Tables\Derived\Fatigue\FatigueTable;
use DrdPlus\Tables\Derived\Price\PriceTable;
use DrdPlus\Tables\Base\Speed\SpeedTable;
use DrdPlus\Tables\Base\Time\TimeTable;
use DrdPlus\Tables\Base\Weight\WeightTable;
use DrdPlus\Tables\Base\Wounds\WoundsTable;
use Granam\Strict\Object\StrictObject;

class Tables extends StrictObject
{

    /**
     * @var AmountTable
     */
    private $amountTable;

    /**
     * @var BaseOfWoundsTable
     */
    private $baseOfWoundsTable;

    /**
     * @var DistanceTable
     */
    private $distanceTable;

    /**
     * @var ExperiencesTable
     */
    private $experiencesTable;
    /**
     * @var FatigueTable
     */
    private $fatigueTable;

    /**
     * @var PriceTable
     */
    private $priceTable;

    /**
     * @var SpeedTable
     */
    private $speedTable;

    /**
     * @var TimeTable
     */
    private $timeTable;

    /**
     * @var WeightTable
     */
    private $weightTable;

    /**
     * @var WoundsTable
     */
    private $woundsTable;

    public function __construct()
    {
        $this->amountTable = new AmountTable();
        $this->baseOfWoundsTable = new BaseOfWoundsTable();
        $this->distanceTable = new DistanceTable();
        $woundsTable = new WoundsTable();
        $this->experiencesTable = new ExperiencesTable($woundsTable);
        $this->fatigueTable = new FatigueTable();
        $this->priceTable = new PriceTable($this->amountTable);
        $this->speedTable = new SpeedTable();
        $this->timeTable = new TimeTable();
        $this->weightTable = new WeightTable();
        $this->woundsTable = $woundsTable;
    }

    /**
     * @return AmountTable
     */
    public function getAmountTable()
    {
        return $this->amountTable;
    }

    /**
     * @return BaseOfWoundsTable
     */
    public function getBaseOfWoundsTable()
    {
        return $this->baseOfWoundsTable;
    }

    /**
     * @return DistanceTable
     */
    public function getDistanceTable()
    {
        return $this->distanceTable;
    }

    /**
     * @return ExperiencesTable
     */
    public function getExperiencesTable()
    {
        return $this->experiencesTable;
    }

    /**
     * @return FatigueTable
     */
    public function getFatigueTable()
    {
        return $this->fatigueTable;
    }

    /**
     * @return PriceTable
     */
    public function getPriceTable()
    {
        return $this->priceTable;
    }

    /**
     * @return SpeedTable
     */
    public function getSpeedTable()
    {
        return $this->speedTable;
    }

    /**
     * @return TimeTable
     */
    public function getTimeTable()
    {
        return $this->timeTable;
    }

    /**
     * @return WeightTable
     */
    public function getWeightTable()
    {
        return $this->weightTable;
    }

    /**
     * @return WoundsTable
     */
    public function getWoundsTable()
    {
        return $this->woundsTable;
    }

}
