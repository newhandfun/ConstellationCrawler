<?php
namespace App\Repositories\Modules\Constellation;

use Carbon\Carbon;
use App\Entities\Constellation;
use Illuminate\Support\Collection;
use App\Entities\ConstellationFate;
use Symfony\Component\DomCrawler\Crawler;
use App\Repositories\Modules\Constellation\FateProperty;

class HtmlToEntites{


    /**
     * 整體運在html的順位
     */
    const INDEX_SUMMARY = 0;
    /**
     * 愛情運在html的順位
     */
    const INDEX_LOVE = 1;
    /**
     * 事業運在html的順位
     */
    const INDEX_BUSINESS = 2;
    /**
     * 財運在html的順位
     */
    const INDEX_MONEY = 3;

    /**
     * @var FateProperty
     */
    private $fate_getter;

    public function __construct(
        FateProperty $fate_getter
    )
    {
        $this->fate_getter  = $fate_getter;
    }

    public function transform() : Collection{
        $entities = collect(Constellation::TYPE_NAMES)
            ->map(function($name,$type){
                return $this->crawConstellation($type);
            });

        return $entities;
    }

    private function crawConstellation(int $type){
        $site = $this->getUrl($type);
        $crawler = new Crawler(file_get_contents($site));

        return new Constellation(
            $type,null,
            $this->fate_getter->transform($crawler,self::INDEX_SUMMARY,ConstellationFate::TYPE_SUMMARY),
            $this->fate_getter->transform($crawler,self::INDEX_LOVE,ConstellationFate::TYPE_LOVE),
            $this->fate_getter->transform($crawler,self::INDEX_BUSINESS,ConstellationFate::TYPE_BUSINESS),
            $this->fate_getter->transform($crawler,self::INDEX_MONEY,ConstellationFate::TYPE_MONEY)
        );
    }

    private function getUrl(int $type){
        $date_text = date('Y-m-d');
        return "https://astro.click108.com.tw/daily_{$type}.php?iAcDay={$date_text}&iAstro={$type}";
    }
}
