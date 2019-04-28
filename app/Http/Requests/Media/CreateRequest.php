<?php
declare(strict_types=1);

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class CreateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'video_file'     => [
                'required',
                'file',
//                 'mimetypes:video/avi,video/mpeg,video/quicktime',
                'max:102400',// (KB) <-100MB
            ],

            'leagues'        => 'sometimes|array',
            'leagues.*'      => 'nullable|string|exists:leagues,name',
            'universities'   => 'sometimes|array',
            'universities.*' => 'nullable|string|exists:universities,name',
            'sports'         => 'sometimes|array',
            'sports.*'       => 'sometimes|required|string|exists:sports,name',
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     * @return array
     */
    public function messages(): array
    {
        return [
            //
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     * @return array
     */
    public function attributes(): array
    {
        return \Lang::get('attributes.users');
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
//         $this->errorBag = snake_case(studly_case(strtr(str_after(__CLASS__, 'App\\Http\\Requests\\'), '\\', '_')));
    }
}
