<?php
declare(strict_types=1);

namespace App\Http\Requests\Media;

final class UpdateRequest extends MediaRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'description' => [
                'nullable',
                'max:248',
            ],
            'long_description' => [
                'nullable',
                'max:5000',
            ],
            'starts_at' => [
                'nullable',
                'max:16',
                'date_format:Y/m/d H:i',
            ],
            'ends_at' => [
                'nullable',
                'max:16',
                'date_format:Y/m/d H:i',
            ],
            'date' => [
                'nullable',
                'max:10',
                'date_format:Y/m/d',
            ],
            'rightholder' => [
                'nullable',
                'max:255',
            ],
            'tournament' => [
                'nullable',
                'max:255',
            ],
            'leagues' => [
                'sometimes',
                'array',
            ],
            'leagues.*' => [
                'sometimes',
                'nullable',
                'string',
                'distinct',
                'exists:leagues,name',
            ],
            'universities' => [
                'sometimes',
                'array',
            ],
            'universities.*' => [
                'sometimes',
                'nullable',
                'string',
                'distinct',
                'exists:universities,name',
            ],
            'sports' => [
                'sometimes',
                'array',
            ],
            'sports.*' => [
                'sometimes',
                'nullable',
                'string',
                'distinct',
                'exists:sports,name',
            ],
            'state' => [
                'required',
                'in:ACTIVE,INACTIVE',
            ],
        ];
    }
}
