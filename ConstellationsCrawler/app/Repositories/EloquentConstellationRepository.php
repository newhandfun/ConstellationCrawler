<?php
namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Entities\Constellation as ConstellationEntity;
use App\Entities\ConstellationFate as ConstellationFateEntity;
use App\Models\Constellation;
use App\Models\ConstellationFate;
use App\Repositories\Modules\Constellation\HtmlToEntites;
use App\Repositories\Contracts\ConstellationReaderRepository;
use App\Repositories\Contracts\ConstellationWriterRepository;

class EloquentConstellationRepository implements ConstellationReaderRepository,ConstellationWriterRepository{

    /**
     * @var HtmlToEntites
     */
    protected $crawler;

    public function __construct(
        HtmlToEntites $crawler
    )
    {
        $this->crawler = $crawler;
    }

    public function fromWeb(): Collection
    {
        return $this->crawler->transform();
    }

    public function entitiesToDB(Collection $constellations)
    {
        $fate_properties =  [
            'summary_fate',
            'business_fate',
            'love_fate',
            'money_fate',
        ];

        $updated_date = $this->getUpdatedDate();

        $constellations->each(function(ConstellationEntity $constellation)use($fate_properties,$updated_date){
            $constellation->updated_date = $updated_date;
            $constellationType = $constellation->type;

            //刷新星座更新時間
            Constellation::query()
                ->where([
                    'type'  =>  $constellationType
                ])
                ->update([
                    'updated_date'    =>  $updated_date,
                ]);


            foreach($fate_properties as $property){
                /**
                 * @var ConstellationFateEntity
                 */
                $fate = $constellation->$property;
                $search_properties = [
                    'constellation_type' => $constellationType,
                    'type'          =>  $fate->type,
                    'created_date' => $updated_date,
                ];
                $update_properties = [
                    'score' => $fate->score,
                    'introduction' => $fate->introduction,
                ];

                /**
                 * 找尋今日該星座與運勢種類的資料列
                 * 若有則更新，反之則新增。
                 */
                $fate_model = ConstellationFate::where($search_properties)
                    ->whereDate('created_date',$updated_date)
                    ->first();

                if ( $fate_model ) {
                    $fate_model->update($update_properties);

                    continue;
                }

                ConstellationFate::create(
                    array_merge($search_properties,$update_properties)
                );
            }
        });
    }

    private function getUpdatedDate(){
        return Carbon::today();
    }
}
