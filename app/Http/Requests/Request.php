<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
	/**
     * The sanitized input.
     *
     * @var array
     */
    protected $sanitized;

    public function validator($factory): mixed
    {
        return $factory->make(
            $this->sanitizeInput(), $this->container->call([$this, 'rules']), $this->messages()
        );
    }

    /**
     * Sanitize the input.
     *
     * @return array
     */
    protected function sanitizeInput(): mixed
    {
        if (method_exists($this, 'sanitize'))
        {
            return $this->sanitized = $this->container->call([$this, 'sanitize']);
        }

        return $this->all();
    }
    /**
     * Get sanitized input.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function sanitized($key = null, $default = null): mixed
    {
        $input = is_null($this->sanitized) ? $this->all() : $this->sanitized;
        return array_get($input, $key, $default);
    }
}
