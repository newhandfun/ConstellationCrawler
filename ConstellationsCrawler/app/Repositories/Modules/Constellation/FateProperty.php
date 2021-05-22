<?php
namespace App\Repositories\Modules\Constellation;

use App\Entities\ConstellationFate;
use Symfony\Component\DomCrawler\Crawler;

class FateProperty{

    public function transform(Crawler $crawler,int $index,int $fate_type){
        $fate_query = 'div.TODAY_CONTENT>p';
        $introductionIndex = $index * 2 + 1;
        $score_index = $index * 2;

        //說明欄位則可以直接透過p的文字取得
        $introduction = $crawler->filter($fate_query)
            ->eq($introductionIndex)
            ->text();

        //評分則是包含星星的字串
        //需要解析裡面包含幾個星星
        $score_text = $crawler->filter($fate_query)
            ->eq($score_index)
            ->text();
        $score = substr_count($score_text,'★');

        return new ConstellationFate($fate_type,$score,$introduction);
    }
}
