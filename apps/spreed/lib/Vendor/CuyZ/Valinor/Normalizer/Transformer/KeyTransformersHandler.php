<?php

declare(strict_types=1);

namespace OCA\Talk\Vendor\CuyZ\Valinor\Normalizer\Transformer;

use OCA\Talk\Vendor\CuyZ\Valinor\Definition\AttributeDefinition;
use OCA\Talk\Vendor\CuyZ\Valinor\Definition\MethodDefinition;
use OCA\Talk\Vendor\CuyZ\Valinor\Normalizer\Exception\KeyTransformerHasTooManyParameters;
use OCA\Talk\Vendor\CuyZ\Valinor\Normalizer\Exception\KeyTransformerParameterInvalidType;
use OCA\Talk\Vendor\CuyZ\Valinor\Type\StringType;

/** @internal */
final class KeyTransformersHandler
{
    /** @var array<string, true> */
    private array $keyTransformerCheck = [];

    /**
     * @param list<AttributeDefinition> $attributes
     */
    public function transformKey(string|int $key, array $attributes): string|int
    {
        foreach ($attributes as $attribute) {
            if (! $attribute->class->methods->has('normalizeKey')) {
                continue;
            }

            $method = $attribute->class->methods->get('normalizeKey');

            $this->checkKeyTransformer($method);

            if ($method->parameters->count() === 0 || $method->parameters->at(0)->type->accepts($key)) {
                $key = $attribute->instantiate()->normalizeKey($key); // @phpstan-ignore-line / We know the method exists
            }
        }

        /** @var array-key */
        return $key;
    }

    private function checkKeyTransformer(MethodDefinition $method): void
    {
        if (isset($this->keyTransformerCheck[$method->signature])) {
            return;
        }

        // @infection-ignore-all
        $this->keyTransformerCheck[$method->signature] = true;

        $parameters = $method->parameters;

        if ($parameters->count() > 1) {
            throw new KeyTransformerHasTooManyParameters($method);
        }

        if ($parameters->count() > 0) {
            $type = $parameters->at(0)->type;

            if (! $type instanceof StringType) {
                throw new KeyTransformerParameterInvalidType($method);
            }
        }
    }
}
