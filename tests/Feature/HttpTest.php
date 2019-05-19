<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Model\Eloquent\User;
use Tests\TestCase;

final class HttpTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function 未認証アカウント()
    {
        $this->get(route('home'))->assertRedirect(route('login'));

        /**
         * Password Reset
         */
        $this->get(route('password.request'))->assertStatus(200);
        $this->post(route('password.email'))->assertRedirect(route('password.request'));// 422のためリダイレクトバック
        $this->get(route('password.reset', ['token' => 'abc']))->assertStatus(200);
        $this->post(route('password.request'))->assertRedirect(route('password.reset', ['token' => 'abc']));// 422のためリダイレクトバック

        /**
         * Authentication
         */
        $this->get(route('login'))->assertStatus(200);
        $this->post(route('login'))->assertRedirect(route('login'));// 422のためリダイレクトバック
        $this->get(route('logout'))->assertStatus(405);
        $this->post(route('logout'))->assertRedirect(route('login'));
    }

    /**
     * @test
     * @return void
     */
    public function 認証済アカウント()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('home'))->assertStatus(200);

        /**
         * Password Reset
         */
        $this->get(route('password.request'))->assertRedirect(route('home'));
        $this->post(route('password.email'))->assertRedirect(route('home'));
        $this->get(route('password.reset', ['token' => 'abc']))->assertRedirect(route('home'));
        $this->post(route('password.request'))->assertRedirect(route('home'));

        /**
         * Authentication
         */
        $this->get(route('login'))->assertRedirect(route('home'));
        $this->post(route('login'))->assertRedirect(route('home'));
        $this->get(route('logout'))->assertStatus(405);
        $this->post(route('logout'))->assertRedirect(route('login'));
    }
}
