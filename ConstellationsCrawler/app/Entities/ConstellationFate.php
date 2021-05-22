<?php
namespace App\Entities;

class ConstellationFate{

    /**
     * 整體運在html的順位
     */
    const TYPE_SUMMARY = 0;
    /**
     * 愛情運在html的順位
     */
    const TYPE_LOVE = 1;
    /**
     * 事業運在html的順位
     */
    const TYPE_BUSINESS = 2;
    /**
     * 財運在html的順位
     */
    const TYPE_MONEY = 3;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $score;

    /**
     * @var string
     */
    private $introduction;

    public function __construct(
        int $type,int $score,string $introduction
        )
    {
        $this->type = $type;
        $this->score = $score;
        $this->introduction = $introduction;
    }

    public function __get($property){
        if( property_exists($this,$property) ){
            return $this->$property;
        }
    }
}
