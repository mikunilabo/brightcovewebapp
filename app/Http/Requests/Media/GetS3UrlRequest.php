<?php
declare(strict_types=1);

namespace App\Http\Requests\Media;

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
                'max:255',
            ],
        ];
    }
}
