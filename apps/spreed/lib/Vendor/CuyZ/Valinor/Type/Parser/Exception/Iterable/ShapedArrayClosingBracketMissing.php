<?php

declare(strict_types=1);

namespace OCA\Talk\Vendor\CuyZ\Valinor\Type\Parser\Exception\Iterable;

use OCA\Talk\Vendor\CuyZ\Valinor\Type\Parser\Exception\InvalidType;
use OCA\Talk\Vendor\CuyZ\Valinor\Type\Type;
use OCA\Talk\Vendor\CuyZ\Valinor\Type\Types\ShapedArrayElement;
use RuntimeException;

use function implode;

/** @internal */
final class ShapedArrayClosingBracketMissing extends RuntimeException implements InvalidType
{
    /**
     * @param ShapedArrayElement[] $elements
     */
    public function __construct(array $elements, Type|null|false $unsealedType = null)
    {
        $signature = 'array{' . implode(', ', array_map(fn (ShapedArrayElement $element) => $element->toString(), $elements));

        if ($unsealedType === false) {
            $signature .= ', ...';
        } elseif ($unsealedType instanceof Type) {
            $signature .= ', ...' . $unsealedType->toString();
        }

        parent::__construct(
            "Missing closing curly bracket in shaped array signature `$signature`.",
            1631283658
        );
    }
}
