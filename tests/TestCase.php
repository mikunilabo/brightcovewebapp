<?php
declare(strict_types=1);

namespace Tests;

use App\Model\Eloquent\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var User */
    protected $admin;

    /** @var User */
    protected $user;

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->commands();
        $this->users();
    }

    /**
     * @return void
     */
    private function commands()
    {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
    }

    /**
     * @return void
     */
    private function users()
    {
        $this->admin = factory(User::class)->create([
            'name' => 'admin',
            'company' => 'Admin, Inc.',
            'email' => 'admin@example.com',
            'role_id' => 1,
        ]);

        $this->user = factory(User::class)->create([
            'name' => 'user',
            'company' => 'User, Inc.',
            'email' => 'user@example.com',
            'role_id' => 2,
        ]);
    }
}
