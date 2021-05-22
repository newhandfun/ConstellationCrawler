<?php
namespace App\Entities;

use Carbon\Carbon;
use App\Entities\ConstellationFate;
use Exception;

class Constellation{

    /**
     * 牡羊座
     */
    const TYPE_ARIES = 0;
    /**
     * 金牛座
     */
    const TYPE_TAURUS = 1;
    /**
     * 雙子座
     */
    const TYPE_GEMINI = 2;
    /**
     * 巨蟹座
     */
    const TYPE_CANCER = 3;
    /**
     * 獅子座
     */
    const TYPE_LEO = 4;
    /**
     * 處女座
     */
    const TYPE_VIRGO = 5;
    /**
     * 天秤座
     */
    const TYPE_LIBRA = 6;
    /**
     * 天蠍座
     */
    const TYPE_SCORPIO = 7;
    /**
     * 射手座
     */
    const TYPE_SAGITTARIUS = 8;
    /**
     * 摩羯座
     */
    const TYPE_CAPRICORN = 9;
    /**
     * 水瓶座
     */
    const TYPE_AQUARIUS = 10;
    /**
     * 雙魚座
     */
    const TYPE_PISCES = 11;

    /**
     * 各type對照星座名稱的表
     */
    const TYPE_NAMES = [
        self::TYPE_ARIES => '牡羊座',
        self::TYPE_TAURUS => '金牛座',
        self::TYPE_GEMINI => '雙子座',
        self::TYPE_CANCER => '巨蟹座',
        self::TYPE_LEO => '獅子座',
        self::TYPE_VIRGO => '處女座',
        self::TYPE_LIBRA => '天秤座',
        self::TYPE_SCORPIO => '天蠍座',
        self::TYPE_SAGITTARIUS => '射手座',
        self::TYPE_CAPRICORN => '摩羯座',
        self::TYPE_AQUARIUS => '水瓶座',
        self::TYPE_PISCES => '雙魚座',
    ];

    /**
     * @var int
     */
    private $type;

    /**
     * @var ConstellationFate
     */
    private $summary_fate;

    /**
     * @var ConstellationFate
     */
    private $love_fate;

    /**
     * @var ConstellationFate
     */
    private $business_fate;

    /**
     * @var ConstellationFate
     */
    private $money_fate;

    public function __construct(
        int $type,?Carbon $updated_at,
        ConstellationFate $summary_fate,ConstellationFate $love_fate,
        ConstellationFate $business_fate,ConstellationFate $money_fate
        )
    {
        $this->type = $type;
        $this->updated_at = $updated_at;
        $this->summary_fate = $summary_fate;
        $this->business_fate = $business_fate;
        $this->love_fate = $love_fate;
        $this->money_fate = $money_fate;
    }

    public function __get($property){
        //星座名稱
        if( $property == "name" ){
            if( !array_key_exists($this->type,self::TYPE_NAMES) ){
                throw new Exception("該種類的星座不存在 : {$this->type}");
            }
            return self::TYPE_NAMES[$this->type];
        }
        if ( property_exists($this, $property) ) {
            return $this->$property;
        }
    }

    public function __set($property,$value){
        if( $property == "updated_at" ){
            $this->$property = $value;
        }
    }
}
