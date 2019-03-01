<?php

namespace Toodoo\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh', ['--database' => 'mysql_test']);
    }
}
