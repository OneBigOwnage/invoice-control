<?php

namespace App;

class BreadCrumbs
{
    protected static $breadCrumbs = [];

    public static function get()
    {
        return self::$breadCrumbs;
    }

    public static function set($breadCrumbs)
    {
        self::$breadCrumbs = $breadCrumbs;
    }
}
