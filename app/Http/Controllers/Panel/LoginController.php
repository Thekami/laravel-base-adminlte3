<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use Auth;

class LoginController extends Controller
{
    public function show(){
        return Auth::check() ? redirect('/home') : view('auth.login');
    }

    public function login(LoginRequest $request){
        
        // Login usgin Auth API Controller
        $auth = new AuthController();
        $res  = $auth->login($request);
        $data = json_decode($res->getContent());

        // Validate response
        if($res->status() == 200 && $data->success == true){

            $credentials = $request->getCredentials(); // Formating credentials usgin the original request
            $user        = Auth::getProvider()->retrieveByCredentials($credentials); // ??

            Session::put('api_token', $data->data->access_token); // Put token as session variale
            Auth::login($user);
        }
        else{
            return redirect()->to('/login')->withErrors('auth.failed');
        }

        return redirect('/home');
    }
  
    public function logout(){
        Session::flush(); // Delete all session variables
        Auth::logout(); 
        return redirect('/login');
    }

    public function impersonateUser($userId){
        
        $user = User::findOrFail($userId);

        // Get the user active token (last generated token)
        $tokenModel = $user->tokens()->latest()->first();

        $tokenModel = !$tokenModel 
                    ? $user->createToken('Impersonate Token')->plainTextToken 
                    : $tokenModel->plainTextToken;

        // Put token as sessión variable into sessión admin
        session(['impersonate_token' => $tokenModel->plainTextToken]);

        // Authenticates the administrator as the specified user
        Auth::loginUsingId($user->id);

        return redirect('/panel')->with('message', 'You are now impersonating ' . $user->name);
    }

    public function stopImpersonating(){
        // Delete sessión 
        session()->forget('impersonate_token');

        // Logout
        Auth::logout();

        // Redirect the administrator back to the administration panel 
        return redirect('/admin')->with('message', 'You are now back to your original account');
    }
}
