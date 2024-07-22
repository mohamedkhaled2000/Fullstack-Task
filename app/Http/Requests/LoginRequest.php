<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LoginRequest extends FormRequest
{
    use ApiResponse;
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
            'email'         => 'required|email',
            'password'      => 'required'
        ];
    }

    public function authenticate() {
        $validated = $this->validated();

        $type = $this->routeIs('client-api.*') ? 'client' : 'admin';
        $validated['type'] = $type;

        if (!Auth::attempt($validated)) {
            throw new HttpException(401, 'Wrong email or password');
        }

        return Auth::user();
    }
}
