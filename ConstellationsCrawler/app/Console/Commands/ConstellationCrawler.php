<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Constellation\ConstellationCrawlerService;
use App\Services\Constellation\ConstellationStoreService;

class ConstellationCrawler extends Command
{
    /**
     * @var string
     */
    protected $signature = 'constellation:craw {--test : (測試用)測試爬蟲功能而不做寫入資料庫的動作} {--log : (檢查用)執行時會產生各Entity的json檔結果。}';

    /**
     * @var string
     */
    protected $description = '爬蟲並依據當天星座網站結果更新資料庫資料。';


    /**
     * @var ConstellationCrawlerService
     */
    private $constellation_crawler_service;
    /**
     * @var ConstellationStoreService
     */
    private $constellation_store_service;


    public function __construct(
        ConstellationCrawlerService $constellation_crawler_service,
        ConstellationStoreService $constellation_store_service
    )
    {
        parent::__construct();

        $this->constellation_crawler_service = $constellation_crawler_service;
        $this->constellation_store_service = $constellation_store_service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $constellations = $this->constellation_crawler_service->execute();

        if( !$this->option('test') )
            $this->constellation_store_service->execute($constellations);
    }
}
