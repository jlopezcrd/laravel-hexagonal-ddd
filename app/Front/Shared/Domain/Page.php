<?php

declare(strict_types = 1);

namespace Developez\Front\Shared\Domain;

interface Page
{
    public static function fromJson(string $serialized): Page;

    public static function fromArray(array $data): Page;

    public function getHead(): string;

    public function getBody(): string;

    public function toJson(): string;

    public function toArray(): array;

    public function isPage(string $page): bool;
}
