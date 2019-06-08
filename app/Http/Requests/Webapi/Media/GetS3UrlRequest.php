<?php
declare(strict_types=1);

namespace App\Http\Requests\Webapi\Media;

use App\Http\Requests\Media\MediaRequest;

final class GetS3UrlRequest extends MediaRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'source' => [
                'required',
                'string',
                'max:5000',
            ],
        ];
    }
}
