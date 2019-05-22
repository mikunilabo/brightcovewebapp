<?php
declare(strict_types=1);

namespace App\Http\Requests\Webapi\Media;

use App\Http\Requests\Media\MediaRequest;

final class DynamicIngestRequest extends MediaRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'master_url' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
