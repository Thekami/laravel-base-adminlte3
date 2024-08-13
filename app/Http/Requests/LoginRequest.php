<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user' => 'required',
            'password' => 'required'
        ];
    }

    public function getCredentials(){
        $credentials = ['password' => $this->password];

        // Check if user field contains an email or username
        $field = filter_var($this->user, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Make a credentials array
        $credentials = [
            $field => $this->user,
            'password' => $this->password,
        ];

        return $credentials;
    }

    private function isEmail($value){
        $factory = $this->container->make(ValidationFactory::class);
        return !$factory->make(['user'=>$value], ['user', 'email'])->fails();
    }
}
