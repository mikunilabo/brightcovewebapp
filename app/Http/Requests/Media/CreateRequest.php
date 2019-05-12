<?php
declare(strict_types=1);

namespace App\Http\Requests\Media;

final class CreateRequest extends MediaRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
//             'name' => [
//                 'required',
//                 'string',
//                 'max:255',
//             ],

//             'leagues'        => 'sometimes|array',
//             'leagues.*'      => 'nullable|string|exists:leagues,name',
//             'universities'   => 'sometimes|array',
//             'universities.*' => 'nullable|string|exists:universities,name',
//             'sports'         => 'sometimes|array',
//             'sports.*'       => 'sometimes|required|string|exists:sports,name',
        ];
    }
}
