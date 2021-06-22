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

    public function __clone()
    {
    }
    public function __sleep()
    {
    }
    public function __wakeup()
    {
    }
}
