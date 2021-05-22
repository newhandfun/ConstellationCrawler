<?php
namespace App\Repositories\Contracts;

use App\DTOs\UserAuthData;

interface UserLoginRepository{

    /**
     * 確認系統是否有該使用者
     *
     * @return bool
     */
    function userExists(UserAuthData $data);

    /**
     * 驗證使用者登入的資料是否正確
     *
     * @return bool
     */
    function validateUserData(UserAuthData $data);

    /**
     * 使用者登入
     *
     * @return \App\Entities\User
     */
    function userLogin(UserAuthData $data);
}
