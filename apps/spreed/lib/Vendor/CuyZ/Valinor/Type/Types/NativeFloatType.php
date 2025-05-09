<?php

declare(strict_types=1);

namespace OCA\Talk\Vendor\CuyZ\Valinor\Type\Types;

use OCA\Talk\Vendor\CuyZ\Valinor\Mapper\Tree\Message\ErrorMessage;
use OCA\Talk\Vendor\CuyZ\Valinor\Mapper\Tree\Message\MessageBuilder;
use OCA\Talk\Vendor\CuyZ\Valinor\Type\FloatType;
use OCA\Talk\Vendor\CuyZ\Valinor\Type\Type;
use OCA\Talk\Vendor\CuyZ\Valinor\Utility\IsSingleton;

use function assert;
use function is_float;
use function is_numeric;

/** @internal */
final class NativeFloatType implements FloatType
{
    use IsSingleton;

    public function accepts(mixed $value): bool
    {
        return is_float($value);
    }

    public function matches(Type $other): bool
    {
        if ($other instanceof UnionType) {
            return $other->isMatchedBy($this);
        }

        return $other instanceof self
            || $other instanceof MixedType;
    }

    public function canCast(mixed $value): bool
    {
        return is_numeric($value);
    }

    public function cast(mixed $value): float
    {
        assert($this->canCast($value));

        return (float)$value; // @phpstan-ignore-line
    }

    public function errorMessage(): ErrorMessage
    {
        return MessageBuilder::newError('Value {source_value} is not a valid float.')->build();
    }

    public function toString(): string
    {
        return 'float';
    }
}
