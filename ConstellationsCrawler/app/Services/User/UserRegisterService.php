<?php
namespace App\Services\User;

use App\DTOs\UserAuthData;
use App\Events\UserRegistered;
use App\Repositories\Contracts\UserRegisterRepository;

class UserRegisterService{

    /**
     * @var UserRegisterRepository;
     */
    private $user_register_repo;

    public function __construct(UserRegisterRepository $user_register_repo)
    {
        $this->user_register_repo = $user_register_repo;
    }

    /**
     * @return \App\Entities\User
     */
    public function execute(UserAuthData $data){
        $user = $this->user_register_repo->register($data);

        return $user;
    }
}
