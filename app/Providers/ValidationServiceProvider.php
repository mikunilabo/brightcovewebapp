<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;
use Lang;

final class ValidationServiceProvider extends ServiceProvider
{
    /**
     * @param Request $request
     * @return void
     */
    public function boot(Request $request): void
    {
        $this->extends($request);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @param Request $request
     * @return void
     */
    private function extends(Request $request): void
    {
        /** @var Factory $validator */
        $validator = $this->app->make('validator');

        $validator->extend('custom_alpha_dash', function ($attribute, $value) {
            return preg_match("/^[a-z0-9-]+$/i", $value) > 0;
        });

        $validator->extend('email', function ($attribute, $value) {
            return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
        });

        $validator->extend('invalid', function ($attribute, $value) {
            return false;
        });

        $validator->extend('postal_code', function ($attribute, $value) {
            return preg_match("/^[\d]{7}$/u", $value) > 0;
        }, Lang::get('validation.format'));

        $validator->extend('zenkaku_katakana', function ($attribute, $value) {
            return preg_match("/[^ァ-ヶー]/u", $value) === 0;
        });
    }
}
