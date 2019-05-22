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
        $this->get(route('password.request'))->assertSuccessful();
        $this->post(route('password.email'))
            ->assertSessionHasErrors(['email'])
            ->assertRedirect(route('password.request'));
        $this->get(route('password.reset', ['token' => 'abc']))->assertSuccessful();
        $this->post(route('password.request'))
            ->assertSessionHasErrors(['email', 'password'])
            ->assertRedirect(route('password.reset', ['token' => 'abc']));

        /**
         * Authentication
         */
        $this->get(route('login'))->assertSuccessful();
        $this->post(route('login'))
            ->assertSessionHasErrors(['email', 'password'])
            ->assertRedirect(route('login'));
        $this->get(route('logout'))->assertStatus(405);
        $this->post(route('logout'))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function 認証済Adminアカウント管理()
    {
        $this->actingAs($this->admin)->get(route('home'))->assertSuccessful();

        $createUserData = collect([
            'name' => 'created',
            'company' => 'test company',
            'email' => 'test@example.com',
            'role_id' => 2,
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
            'leagues' => 'league1',
            'sports' => ['sport1'],
            'universities' => 'university1',
        ]);
        $updateUserData = collect([
            'name' => 'updated',
            'company' => 'test company3',
            'leagues' => 'league2',
            'sports' => ['sport2'],
            'universities' => 'university2',
        ]);
        $modifyProfileData = collect([
            'name' => 'modified',
            'company' => 'test company2',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
            'leagues' => 'league3',
            'sports' => ['sport3'],
            'universities' => 'university3',
        ]);

        /**
         * Accounts
         */
        $this->get(route('accounts.index'))->assertSuccessful();

        $this->get(route('accounts.create'))->assertSuccessful();
        $this->post(route('accounts.create'))
            ->assertSessionHasErrors(['name', 'email', 'role_id', 'password'])
            ->assertRedirect(route('accounts.create'));
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

        $this->get(route('accounts.detail', 'test'))->assertStatus(404);
        $this->post(route('accounts.detail', 'test'))->assertRedirect(route('accounts.detail', 'test'));// TODO XXX 本来ならバリデート前に404を返す仕組みの方が良いのかもしれない。
        $this->get(route('accounts.detail', $user->id))->assertSuccessful();
        $this->post(route('accounts.detail', $user->id))
            ->assertSessionHasErrors(['name'])
            ->assertRedirect(route('accounts.detail', $user->id));
        $this->post(route('accounts.detail', $user->id), $updateUserData->all())->assertRedirect(route('accounts.detail', $user->id));// 更新成功

        $user = User::where('email', 'test@example.com')->first();
        $this->assertDatabaseHas('users', $updateUserData->forget(['password', 'password_confirmation', 'leagues', 'universities', 'sports'])->all());
        $this->assertDatabaseHas('leagues', ['name' => 'league2']);
        $this->assertDatabaseHas('sports', ['name' => 'sport2']);
        $this->assertDatabaseHas('universities', ['name' => 'university2']);
        $league2 = League::where('name', 'league2')->first();
        $university2 = University::where('name', 'university2')->first();
        $sport2 = Sport::where('name', 'sport2')->first();
        $this->assertDatabaseMissing('league_user', ['league_id' => $league1->id, 'user_id' => $user->id]);
        $this->assertDatabaseMissing('sport_user', ['sport_id' => $sport1->id, 'user_id' => $user->id]);
        $this->assertDatabaseMissing('university_user', ['university_id' => $university1->id, 'user_id' => $user->id]);
        $this->assertDatabaseHas('league_user', ['league_id' => $league2->id, 'user_id' => $user->id]);
        $this->assertDatabaseHas('sport_user', ['sport_id' => $sport2->id, 'user_id' => $user->id]);
        $this->assertDatabaseHas('university_user', ['university_id' => $university2->id, 'user_id' => $user->id]);

        $this->get(route('accounts.profile'))->assertSuccessful();
        $this->post(route('accounts.profile'))
            ->assertSessionHasErrors(['name'])
            ->assertRedirect(route('accounts.profile'));
        $this->post(route('accounts.profile'), $modifyProfileData->all())->assertRedirect(route('accounts.profile'));// 更新成功

        $this->admin = User::where('email', 'admin@example.com')->first();
        $league3 = League::where('name', 'league3')->first();
        $university3 = University::where('name', 'university3')->first();
        $sport3 = Sport::where('name', 'sport3')->first();
        $this->assertDatabaseHas('league_user', ['league_id' => $league3->id, 'user_id' => $this->admin->id]);
        $this->assertDatabaseHas('sport_user', ['sport_id' => $sport3->id, 'user_id' => $this->admin->id]);
        $this->assertDatabaseHas('university_user', ['university_id' => $university3->id, 'user_id' => $this->admin->id]);

        $this->get(route('accounts.delete', 'test'))->assertStatus(405);
        $this->post(route('accounts.delete', 'test'))->assertStatus(404);
        $this->get(route('accounts.delete', $this->admin->id))->assertStatus(405);
        $this->post(route('accounts.delete', $user->id))->assertRedirect(route('accounts.index'));// 削除成功
        $this->post(route('accounts.delete', $this->admin->id))->assertStatus(403);// 自身のIDは削除不可

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

    /**
     * @test
     */
    public function 認証済Userアカウント管理()
    {
        $this->actingAs($this->user)->get(route('home'))->assertSuccessful();

        $modifyProfileData = collect([
            'name' => 'modified',
            'company' => 'test company2',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
            'leagues' => 'test',
            'sports' => ['test'],
            'universities' => 'test',
        ]);

        /**
         * Accounts
         */
        $this->get(route('accounts.index'))->assertStatus(403);
        $this->get(route('accounts.create'))->assertStatus(403);
        $this->post(route('accounts.create'))->assertStatus(403);
        $this->get(route('accounts.detail', $this->admin->id))->assertStatus(403);
        $this->post(route('accounts.detail', $this->admin->id))->assertStatus(403);

        $this->get(route('accounts.profile'))->assertSuccessful();
        $this->post(route('accounts.profile'))
            ->assertSessionHasErrors(['name'])
            ->assertRedirect(route('accounts.profile'));

//         $this->post(route('accounts.profile'), $modifyProfileData->all())
//             ->assertSessionHasErrors(['leagues', 'sports', 'universities'])// マスタが存在しないためバリデートエラー
//             ->assertRedirect(route('accounts.profile'));

        $league = League::create(['name' => 'test']);
        $sport = Sport::create(['name' => 'test']);
        $university = University::create(['name' => 'test']);

        $this->post(route('accounts.profile'), $modifyProfileData->all())->assertRedirect(route('accounts.profile'));// 更新成功

        $this->user = User::where('email', 'user@example.com')->first();
        $this->assertDatabaseHas('league_user', ['league_id' => $league->id, 'user_id' => $this->user->id]);
        $this->assertDatabaseHas('sport_user', ['sport_id' => $sport->id, 'user_id' => $this->user->id]);
        $this->assertDatabaseHas('university_user', ['university_id' => $university->id, 'user_id' => $this->user->id]);

        $this->get(route('accounts.delete', 'test'))->assertStatus(405);
        $this->post(route('accounts.delete', 'test'))->assertStatus(403);
        $this->get(route('accounts.delete', $this->admin->id))->assertStatus(405);
        $this->post(route('accounts.delete', $this->admin->id))->assertStatus(403);

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

    /**
     * @test
     */
    public function 認証済Userメディア管理()
    {
        $this->actingAs($this->user);

        $videoData = collect([
            'name'             => 'Feature test',
            'description'      => 'test',
            'long_description' => 'test',
            'state'            => 'ACTIVE',
            'rightholder'      => 'test',
            'tournament'       => 'test',
            'starts_at'        => '2019/08/01 12:00',
            'ends_at'          => '2019/08/31 18:00',
            'date'             => '2019/08/16',
            'leagues'          => ['全日本大学野球連盟'],
            'sports'           => ['野球'],
            'universities'     => ['早稲田大学'],
        ]);

        $failureVideoData = collect([
            'name'             => str_random(256),
            'description'      => str_random(249),
            'long_description' => str_random(5001),
            'state'            => 'test',
            'rightholder'      => str_random(256),
            'tournament'       => str_random(256),
            'starts_at'        => '2019-08-01 12:00',
            'ends_at'          => '2019-08-31 18:00',
            'date'             => '2019-08-16',
            'leagues'          => ['test連盟'],
            'sports'           => ['testスポーツ'],
            'universities'     => ['test大学'],
        ]);

        /**
         * Media
         */
        $this->get(route('media.index'))->assertSuccessful();
        $this->post(route('media.index'))->assertStatus(405);

        $this->get(route('media.upload'))->assertSuccessful();
        $this->post(route('media.upload'))->assertStatus(405);

        $this->get(route('webapi.media.create'))->assertStatus(405);
        $this->post(route('webapi.media.create'))->assertStatus(403);

        $this->get(route('media.detail', 'test'))->assertStatus(404);
        $this->post(route('media.detail', 'test'))->assertStatus(405);

        $this->get(route('media.delete', 'test'))->assertStatus(405);
        $this->post(route('media.delete', 'test'))->assertStatus(404);

        $this->withHeaders(self::XML_HTTP_REQUEST_HEADER);

        $this->post(route('webapi.media.create'))->assertJsonValidationErrors(['name']);
        $this->post(route('webapi.media.create'), $failureVideoData->all())->assertJsonValidationErrors($failureVideoData->forget(['state', 'leagues', 'sports', 'universities'])->keys()->merge(['leagues.0', 'sports.0', 'universities.0'])->all());
        $response = $this->post(route('webapi.media.create'), $videoData->all())->assertSuccessful();
        $videoId = $response->getData()->id;

        $this->withHeaders([]);

        $this->get(route('media.detail', $videoId))->assertSuccessful();
        $this->post(route('media.detail', $videoId))->assertStatus(405);
        $this->post(route('media.delete', $videoId))->assertRedirect(route('media.index'));

        $this->withHeaders(self::XML_HTTP_REQUEST_HEADER);

        $response = $this->post(route('webapi.media.create'), $videoData->all())->assertSuccessful();
        $videoId = $response->getData()->id;

        $this->post(route('webapi.media.ingestjobs', $videoId))->assertStatus(405);
        $response = $this->get(route('webapi.media.ingestjobs', $videoId))->assertSuccessful();
        $this->assertSame(0, count($response->getData()));

        $this->get(route('webapi.media.update', $videoId))->assertStatus(405);
        $this->post(route('webapi.media.update', $videoId))->assertJsonValidationErrors(['name', 'state']);
        $this->post(route('webapi.media.update', $videoId), ['name' => 'Update test.', 'state' => 'test'])->assertJsonValidationErrors(['state']);
        $this->post(route('webapi.media.update', $videoId), $videoData->all())->assertSuccessful();

        $this->get(route('webapi.media.s3_url', $videoId))->assertStatus(405);
        $this->post(route('webapi.media.s3_url', $videoId))->assertJsonValidationErrors(['source']);
        $response = $this->post(route('webapi.media.s3_url', $videoId), ['source' => 'example.mp4'])->assertSuccessful();
        $masterUrl = $response->getData()->api_request_url;

        $this->get(route('webapi.media.ingest', $videoId))->assertStatus(405);
        $this->post(route('webapi.media.ingest', $videoId))->assertJsonValidationErrors(['master_url']);
        $this->post(route('webapi.media.ingest', $videoId), ['master_url' => $masterUrl])->assertSuccessful();

        $response = $this->get(route('webapi.media.ingestjobs', $videoId))->assertSuccessful();
        $this->assertTrue(count($response->getData()) > 0);

        $this->get(route('webapi.media.activates'))->assertStatus(405);
        $this->post(route('webapi.media.activates'))->assertJsonValidationErrors(['ids']);
        $this->post(route('webapi.media.activates'), ['ids' => [$videoId]])->assertSuccessful();

        $this->get(route('webapi.media.deactivates'))->assertStatus(405);
        $this->post(route('webapi.media.deactivates'))->assertJsonValidationErrors(['ids']);
        $this->post(route('webapi.media.deactivates'), ['ids' => [$videoId]])->assertSuccessful();

        $this->get(route('webapi.media.deletes'))->assertStatus(405);
        $this->post(route('webapi.media.deletes'))->assertJsonValidationErrors(['ids']);
        $this->post(route('webapi.media.deletes'), ['ids' => [$videoId]])->assertSuccessful();
    }
}
