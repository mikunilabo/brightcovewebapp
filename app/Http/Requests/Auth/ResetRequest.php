<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

final class ResetRequest extends AuthRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|string|email|max:255|exists:users',
            'password' => 'required|string|min:8|max:16|confirmed',
        ];
    }
}
