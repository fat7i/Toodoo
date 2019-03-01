<?php

namespace Toodoo\Helpers;

use Faker\Provider\Uuid;

class Helper
{
    /**
     * @return string
     */
    public static function uuid()
    {
        return Uuid::uuid();
    }
}