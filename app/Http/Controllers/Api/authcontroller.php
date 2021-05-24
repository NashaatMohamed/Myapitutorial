<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\traits\Generaltrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class authcontroller extends Controller
{
    use Generaltrait;
    public function login(request $request){
    //validator
        try {
            $rules= ['email' => 'required','password'=> 'required'];
            $validator = validator::make($request -> all(),$rules);
            if ($validator -> fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            //login
            $credentials = $request->only(['email','password']);
            $token =Auth::guard('admin_api')->attempt($credentials);
            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');
            //return token
            $admin = Auth::guard('admin_api') -> user();
            $admin -> api_token =$token;
            return $this ->returndata("admin",$admin,'انت معلم يا ابا مسا عليك');
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function logout(request $request){
        $token = $request -> header('auth-token');
        if ($token){
            try {
                JWTAuth::settoken($token)->invalidate(); //logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return $this ->ReturnError('','التوكن بتاعك غلط ');
            }
            return  $this ->returnsuccesstatus('','(logout)اطلع بره بيتى');
        }else{
            return $this ->ReturnError('e500','روح العب بعيد مافيش توكن') ;
        }
    }
}
