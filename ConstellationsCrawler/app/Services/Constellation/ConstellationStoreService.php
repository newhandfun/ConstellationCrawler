<?php
namespace App\Services\Constellation;

use Illuminate\Support\Collection;
use App\Repositories\Contracts\ConstellationWriterRepository;

class ConstellationStoreService{

    /**
     * @var ConstellationWriterRepository
     */
    protected $write_repo;

    public function __construct(ConstellationWriterRepository $write_repo)
    {
        $this->write_repo = $write_repo;
    }

    /**
     * @param Collection<\App\Entities\Constellation>
     */
    public function execute(Collection $constellations){
        $this->write_repo->entitiesToDB($constellations);
    }
}
