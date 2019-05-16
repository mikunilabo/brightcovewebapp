<?php
declare(strict_types=1);

namespace App\Http\Requests\Users;

final class ProfileRequest extends UsersRequest
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
            'password' => [
                'nullable',
                'string',
                'min:8',
                'max:16',
                'confirmed',
            ],

            'leagues' => [
                'nullable',
                $this->user()->cant('authorize', 'user-create') ? 'exists:leagues,name' : '',
                'string',
                'max:255',
            ],
            'universities' => [
                'nullable',
                $this->user()->cant('authorize', 'user-create') ? 'exists:universities,name' : '',
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
                $this->user()->cant('authorize', 'user-create') ? 'exists:sports,name' : '',
                'string',
                'distinct',
                'max:255',
            ]
        ];
    }
}
