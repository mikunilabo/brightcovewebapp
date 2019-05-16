<?php
declare(strict_types=1);

namespace App\Http\Requests\Users;

final class UpdateRequest extends UsersRequest
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
