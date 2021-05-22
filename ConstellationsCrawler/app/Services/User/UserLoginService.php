<?php
namespace App\Services\User;

use App\Entities\User;
use App\DTOs\UserAuthData;
use Illuminate\Contracts\Support\MessageBag;
use App\Repositories\Contracts\UserLoginRepository;

class UserLoginService{

    /**
     * @var UserLoginRepository
     */
    protected $user_login_repo;

    public function __construct(UserLoginRepository $user_login_repo)
    {
        $this->user_login_repo = $user_login_repo;
    }

    /**
     * @return false|null|User
     */
    public function execute(UserAuthData $data,MessageBag $message_bag){
        if(! $this->user_login_repo->userExists($data)){
            $message_bag->add("account","無此使用者");

            return null;
        }

        if(! $this->user_login_repo->validateUserData($data)){
            $message_bag->add("password","密碼錯誤");

            return false;
        }

        $user = $this->user_login_repo->userLogin($data);

        return $user;
    }
}
