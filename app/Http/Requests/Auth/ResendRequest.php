<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

final class ResendRequest extends AuthRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255',
        ];
    }
}
