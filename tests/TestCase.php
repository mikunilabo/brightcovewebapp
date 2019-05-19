<?php
declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        \Artisan::call('migrate:fresh');
        \Artisan::call('db:seed');
    }
}
