<?php

declare(strict_types=1);

namespace OCA\Talk\Vendor\CuyZ\Valinor\Mapper;

/** @api */
interface ArgumentsMapper
{
    /**
     * @return array<string, mixed>
     *
     * @throws MappingError
     */
    public function mapArguments(callable $callable, mixed $source): array;
}
