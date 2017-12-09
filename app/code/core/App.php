<?php

namespace App\Code\Core;

class App {

    protected static $registry = [];

    public static function set($key, $value) {
        static::$registry[$key] = $value;
    }

    public static function get($key) {
        if(!array_key_exists($key, static::$registry)) {
            throw new Exception('{$key} not found in the App container');
        }

        return static::$registry[$key];
    }
}