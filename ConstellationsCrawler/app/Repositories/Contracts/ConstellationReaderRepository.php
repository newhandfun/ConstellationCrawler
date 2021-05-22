<?php
namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface ConstellationReaderRepository{

    /**
     * 從網路上抓取星座資料並轉成實體
     *
     * @return \Illuminate\Support\Collection<\App\Entities\Constellation>
     */
    public function fromWeb() : Collection;
}
