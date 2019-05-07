<?php
declare(strict_types=1);

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

abstract class MediaRequest extends FormRequest
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
            //
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
        return [
            'name'                  => __('Title'),
            'description'           => __('Description'),
            'long_description'      => __('Keywords'),
            'state'                 => __('Status'),
            'video_file'            => __('Video File'),
            'rightholder'           => __('Rightholder'),
            'tournament'            => __('Tournament'),
            'leagues'               => __('Leagues'),
            'leagues.*'             => __('Leagues'),
            'sports'                => __('Sports'),
            'sports.*'              => __('Sports'),
            'universities'          => __('Universities'),
            'universities.*'        => __('Universities'),
        ];
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
