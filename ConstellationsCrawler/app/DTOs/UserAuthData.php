<?php
namespace App\DTOs;

class UserAuthData{

    /**
     * @var string
     */
    private $account;
    /**
     * @var string
     */
    private $password;

    public function __construct($account,$password)
    {
        $this->account = $account;
        $this->password = $password;
    }

    public function __get($property){
        if(property_exists($this,$property)){
            return $this->$property;
        }
    }
}
