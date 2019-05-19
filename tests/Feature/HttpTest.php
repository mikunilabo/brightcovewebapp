<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Model\Eloquent\League;
use App\Model\Eloquent\Sport;
use App\Model\Eloquent\University;
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
         * Accounts
         */
        $this->get(route('accounts.index'))->assertRedirect(route('login'));
        $this->get(route('accounts.create'))->assertRedirect(route('login'));
        $this->post(route('accounts.create'))->assertRedirect(route('login'));
        $this->get(route('accounts.profile'))->assertRedirect(route('login'));
        $this->post(route('accounts.profile'))->assertRedirect(route('login'));
        $this->get(route('accounts.detail', $this->user->id))->assertRedirect(route('login'));
        $this->post(route('accounts.detail', $this->user->id))->assertRedirect(route('login'));
        $this->get(route('accounts.delete', $this->user->id))->assertStatus(405);
        $this->post(route('accounts.delete', $this->user->id))->assertRedirect(route('login'));

        /**
         * Password Reset
         */
        $this->get(route('password.request'))->assertStatus(200);
        $this->post(route('password.email'))->assertRedirect(route('password.request'));// バリデートエラー(422)のためリダイレクトバック
        $this->get(route('password.reset', ['token' => 'abc']))->assertStatus(200);
        $this->post(route('password.request'))->assertRedirect(route('password.reset', ['token' => 'abc']));// バリデートエラー(422)のためリダイレクトバック

        /**
         * Authentication
         */
        $this->get(route('login'))->assertStatus(200);
        $this->post(route('login'))->assertRedirect(route('login'));// バリデートエラー(422)のためリダイレクトバック
        $this->get(route('logout'))->assertStatus(405);
        $this->post(route('logout'))->assertRedirect(route('login'));
    }

    /**
     * @test
     * @return void
     */
    public function 認証済管理者アカウント()
    {
        $this->actingAs($this->admin)->get(route('home'))->assertStatus(200);

        $createUserData = collect([
            'name' => 'test',
            'email' => 'test@example.com',
            'role_id' => 2,
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
            'leagues' => 'league1',
            'sports' => ['sport1'],
            'universities' => 'university1',
        ]);
//         $modifyProfileData = collect([
//             'name' => 'test2',
//             'company' => 'Test Company',
//         ]);
//         $updateUserData = collect([
//             'name' => 'test2',
//             'company' => 'Test Company',
//         ]);

        /**
         * Accounts
         */
        $this->get(route('accounts.index'))->assertStatus(200);

        $this->get(route('accounts.create'))->assertStatus(200);
        $this->post(route('accounts.create'))->assertRedirect(route('accounts.create'));// バリデートエラー(422)のためリダイレクトバック
        $this->post(route('accounts.create'), $createUserData->all())->assertRedirect(route('accounts.index'));// 作成成功
        $user = User::where('email', 'test@example.com')->first();
        $this->assertDatabaseHas('users', $createUserData->forget(['password', 'password_confirmation', 'leagues', 'universities', 'sports'])->all());
        $this->assertDatabaseHas('leagues', ['name' => 'league1']);
        $this->assertDatabaseHas('sports', ['name' => 'sport1']);
        $this->assertDatabaseHas('universities', ['name' => 'university1']);
        $league1 = League::where('name', 'league1')->first();
        $university1 = University::where('name', 'university1')->first();
        $sport1 = Sport::where('name', 'sport1')->first();
        $this->assertDatabaseHas('league_user', ['league_id' => $league1->id, 'user_id' => $user->id]);
        $this->assertDatabaseHas('sport_user', ['sport_id' => $sport1->id, 'user_id' => $user->id]);
        $this->assertDatabaseHas('university_user', ['university_id' => $university1->id, 'user_id' => $user->id]);

        $this->get(route('accounts.profile'))->assertStatus(200);
        $this->post(route('accounts.profile'))->assertRedirect(route('accounts.profile'));// バリデートエラー(422)のためリダイレクトバック

        $this->get(route('accounts.detail', $this->admin->id))->assertStatus(200);
        $this->post(route('accounts.detail', $this->admin->id))->assertRedirect(route('accounts.detail', $this->admin->id));// バリデートエラー(422)のためリダイレクトバック
        $this->get(route('accounts.detail', 'test'))->assertStatus(404);
        $this->post(route('accounts.detail', 'test'))->assertRedirect(route('accounts.detail', 'test'));// バリデートエラー(422)のためリダイレクトバック TODO XXX 本来ならバリデート前に404を返す仕組みの方が良いのかもしれない。

        $this->get(route('accounts.delete', $this->admin->id))->assertStatus(405);
        $this->post(route('accounts.delete', $this->user->id))->assertRedirect(route('accounts.index'));// 削除成功
        $this->post(route('accounts.delete', $this->admin->id))->assertStatus(403);// 自身のIDは削除不可
        $this->get(route('accounts.delete', 'test'))->assertStatus(405);
        $this->post(route('accounts.delete', 'test'))->assertStatus(404);

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
