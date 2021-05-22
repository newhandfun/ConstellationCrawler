<?php
namespace App\Services\Constellation;

use App\Entities\User;
use App\DTOs\UserAuthData;
use Illuminate\Contracts\Support\MessageBag;
use App\Repositories\Contracts\ConstellationReaderRepository;

class ConstellationCrawlerService{

    /**
     * @var ConstellationReaderRepository
     */
    protected $constellation_read_repo;

    public function __construct(
        ConstellationReaderRepository $constellation_read_repo
        )
    {
        $this->constellation_read_repo = $constellation_read_repo;
    }

    /**
     * @return \Illuminate\Support\Collection<\App\Entities\Constellation>
     */
    public function execute(){
        return $this->constellation_read_repo->fromWeb();
    }
}
