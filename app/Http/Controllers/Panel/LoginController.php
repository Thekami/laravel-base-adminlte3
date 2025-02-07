<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Auth;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    use ResponseTrait;

    public $env;
    protected $controller = "LoginController";

    public function show(): View {
        return view('auth.login');
    }

    public function login(LoginRequest $request): mixed{
        try {
            $credentials = $request->getCredentials(); // Formating credentials usgin the original request
            
            // Validate credentials 
            if(Auth::attempt($credentials)){

                $user = Auth::getProvider()->retrieveByCredentials($credentials); // Generate user from credentials
                Auth::login($user);

                return redirect('/home'); // Redirect to home page
            }
            else{
                return redirect()->to('/login')->withErrors('auth.failed'); // Redirect to login page with error
            }

        } catch (Exception $e) {
            return $this->catchError(Auth::id(), $e, $this->controller, 'login'); // Catch error
        }  
    }

    public function logout(): RedirectResponse{
        Session::flush(); // Delete all session variables
        Auth::logout(); // Logout
        return redirect('/login'); // Redirect to login page
    }

    public function impersonateUser($userId): RedirectResponse{
        
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

    public function stopImpersonating(): RedirectResponse{
        // Delete sessión 
        session()->forget('impersonate_token');

        // Logout
        Auth::logout();

        // Redirect the administrator back to the administration panel 
        return redirect('/admin')->with('message', 'You are now back to your original account');
    }
}
