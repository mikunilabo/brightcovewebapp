<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class ResetRequest extends FormRequest
{
    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @return boolean
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
            'email'    => 'required|string|email|max:191|exists:users',
            'password' => 'required|string|min:8|max:16|confirmed',
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
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
