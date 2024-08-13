<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use Auth;
use Exception;

class AuthController extends Controller
{
    use ResponseTrait;

    public $env;
    protected $controller = "AuthController";

    public function register(RegisterRequest $request){
        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'username' => $request->username,
                'password' => \Hash::make($request->password)
            ]);
        
            return $this->responseCreated($user);

        } catch (Exception $e) {
            return $this->catchError(Auth::id(), $e, $this->controller, 'register');
        }
    }

    public function login(LoginRequest $request){
    
        try {
            
            $credentials = $request->getCredentials();

            // Validate credentials
            if(Auth::attempt($credentials)){

                $user = auth()->user();

                return $this->responseOk([
                    'user' => $user,
                    'access_token' => $user->createToken('auth_token')->plainTextToken,
                    'token_type' => 'Bearer'
                ]);
            }
            else{
                return $this->responseUnautorized('Usuario o contraseña incorrectos');
            }
        } catch (Exception $e) {
            return $this->catchError(Auth::id(), $e, $this->controller, 'login');
        }   
    }

    // protected function catchError($user_id, $error, $controller, $method){

    //     $this->env = config('app.env');
        
    //     // Send error to error_logs table
    //     $ErrorLog = new ErrorLog();
    //     $ErrorLog->saveErrorLog($user_id, $controller, $method, $error);
        
    //     // Validate if send error to end user or not
    //     return $this->env == 'local' 
    //         ? $this->responseError($error->getMessage()) 
    //         : $this->responseError();
    // }
}
