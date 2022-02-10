<?php

declare(strict_types = 1);

namespace Developez\Shared\Domain;

interface Serializable
{
    public static function fromJson(string $serialized);

    public static function fromArray(array $data);

    public function toJson(): string;

    public function toArray(): array;
}
