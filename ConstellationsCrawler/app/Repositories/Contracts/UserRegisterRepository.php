<?php
namespace App\Repositories\Contracts;

use App\DTOs\UserAuthData;

interface UserRegisterRepository{

    /**
     * @return \App\Entities\User
     */
    public function register(UserAuthData $data);
}
