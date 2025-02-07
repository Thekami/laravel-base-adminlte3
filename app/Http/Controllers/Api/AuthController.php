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
use Illuminate\Http\Response;

class AuthController extends Controller
{
    use ResponseTrait;

    public $env;
    protected $controller = "AuthController";

    public function register(RegisterRequest $request): Response{
        try {
            $user = User::create(attributes: [
                'name'     => $request->name,
                'email'    => $request->email,
                'username' => $request->username,
                'password' => \Hash::make(value: $request->password)
            ]);
        
            return $this->responseCreated(data: $user);

        } catch (Exception $e) {
            return $this->catchError(Auth::id(), $e, $this->controller, 'register');
        }
    }

    public function login(LoginRequest $request): Response {
    
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

}
