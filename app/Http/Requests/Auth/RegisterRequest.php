<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

final class RegisterRequest extends AuthRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:16|confirmed',
        ];
    }
}
