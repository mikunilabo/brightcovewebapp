<?php
declare(strict_types=1);

namespace App\Http\Requests\Users;

use Illuminate\Validation\Rule;

final class CreateRequest extends UsersRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'company' => [
                'nullable',
                'string',
                'max:255',
            ],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->whereNotNull('existence'),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'confirmed',
            ],
            'role_id' => [
                'required',
                'numeric',
                'exists:roles,id',
            ],
            'leagues' => [
                'nullable',
                'string',
                'max:255',
            ],
            'universities' => [
                'nullable',
                'string',
                'max:255',
            ],
            'sports' => [
                'sometimes',
                'array',
            ],
            'sports.*' => [
                'sometimes',
                'required',
                'string',
                'distinct',
                'max:255',
            ],
        ];
    }
}
