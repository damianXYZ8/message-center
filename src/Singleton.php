<?php
namespace Utils;

trait Singleton
{
    private static $instance = null;

    protected function __construct()
    {
    }

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    protected function __clone()
    {
    }
    protected function __sleep()
    {
    }
    protected function __wakeup()
    {
    }
}
