<?php
namespace App\Entities;

class User{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $account;

    public function __construct(int $id,string $account)
    {
        $this->id = $id;
        $this->account = $account;
    }

    public function __get($property){
        if(method_exists($this,$property)){
            return $this->$property;
        }
    }
}
