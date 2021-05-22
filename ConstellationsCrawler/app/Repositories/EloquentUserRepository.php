<?php
namespace App\Repositories;

use App\Models\User;
use App\DTOs\UserAuthData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Entities\User as EntitiesUser;
use App\Repositories\Contracts\UserLoginRepository;
use App\Repositories\Contracts\UserRegisterRepository;

class EloquentUserRepository implements UserLoginRepository,UserRegisterRepository{

    public function userExists(UserAuthData $data)
    {
        return User::where('account',$data->account)->exists();
    }

    public function validateUserData(UserAuthData $data)
    {
        $user_model = User::where([
            'account'  =>   $data->account,
        ])->first();

        return Hash::check($data->password,$user_model->password);
    }

    public function userLogin(UserAuthData $data)
    {
        $user_model = User::where('account',$data->account)->first();
        Auth::login($user_model);

        return $this->modelToEntity($user_model);
    }

    public function register(UserAuthData $data)
    {
        $user_model = User::create([
            'account' => $data->account,
            'password' => Hash::make($data->password),
        ]);

        return $this->modelToEntity($user_model);
    }

    private function modelToEntity(User $user_model){
        return new EntitiesUser($user_model->id,$user_model->account);
    }
}
