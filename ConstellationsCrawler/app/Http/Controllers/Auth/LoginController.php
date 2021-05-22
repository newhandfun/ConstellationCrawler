<?php

namespace App\Http\Controllers\Auth;

use App\Services\User\UserLoginService;
use App\Services\User\UserRegisterService;
use App\DTOs\UserAuthData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(
        Request $request,UserLoginService $userLoginService,
        UserRegisterService $userRegisterService
        ){
        //檢查輸入資料格式
        //有需要的話也可以將其包進Service中
        $this->validate($request, [
            'account' => ['required', 'string',  'min:4', 'max:255'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $data = new UserAuthData($request->account,$request->password);
        $message_bag = new MessageBag();

        $user = $userLoginService->execute($data,$message_bag);

        //使用者資訊錯誤
        if( $user===false ){
            return redirect(null,422)
                ->back()
                ->withErrors($message_bag)
                ->withInput();
        }

        //無此使用者
        if( is_null($user) ){
            $userRegisterService->execute($data);
            $user = $userLoginService->execute($data,$message_bag);
        }

        return view('home',['user'=>$user]);
    }

    protected function showLoginForm(){
        return view('auth.login');
    }

    protected function logout(){
        Auth::logout();

        return redirect()->route('login');
    }
}
