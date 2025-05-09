<?php

declare(strict_types=1);

namespace OCA\Talk\Vendor\CuyZ\Valinor\Utility;

/** @internal */
trait IsSingleton
{
    private static self $instance;

    public static function get(): static
    {
        return self::$instance ??= new static();
    }
}
