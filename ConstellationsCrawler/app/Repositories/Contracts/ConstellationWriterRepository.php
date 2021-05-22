<?php
namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface ConstellationWriterRepository{

    /**
     * 將星座資訊匯入至資料庫
     */
    public function entitiesToDB(Collection $constellations);
}
