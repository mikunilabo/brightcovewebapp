<?php
declare(strict_types=1);

namespace App\Http\Requests\Webapi\Media;

use App\Http\Requests\Media\MediaRequest;

final class DeactivatesRequest extends MediaRequest
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
            ],
        ];
    }
}
