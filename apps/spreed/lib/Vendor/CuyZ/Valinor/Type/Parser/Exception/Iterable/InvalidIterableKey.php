<?php

declare(strict_types=1);

namespace OCA\Talk\Vendor\CuyZ\Valinor\Type\Parser\Exception\Iterable;

use OCA\Talk\Vendor\CuyZ\Valinor\Type\Parser\Exception\InvalidType;
use OCA\Talk\Vendor\CuyZ\Valinor\Type\Type;
use RuntimeException;

/** @internal */
final class InvalidIterableKey extends RuntimeException implements InvalidType
{
    public function __construct(Type $keyType, Type $subType)
    {
        parent::__construct(
            "Invalid key type `{$keyType->toString()}` for `iterable<{$keyType->toString()}, {$subType->toString()}>`. " .
            "It must be one of `array-key`, `int` or `string`.",
            1618994708
        );
    }
}
