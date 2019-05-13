<?php
declare(strict_types=1);

namespace App\Http\Requests\Webapi\Users;

use App\Http\Requests\Users\UsersRequest;

final class DeletesRequest extends UsersRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'ids' => [
                'required',
                'array',
                'exists:users,id',
            ],
        ];
    }
}
