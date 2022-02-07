<?php

declare(strict_types = 1);

namespace Developez\Front\Contact\Domain;

final class Contact
{
    public const PAGE = 'contact';

    protected $title;
    protected $body;

    public function __construct(string $title, string $body)
    {
        $this->title = $title;
        $this->body  = $body;
    }

    public static function fromJson(string $serialized): Contact
    {
        $serialized = json_decode($serialized, true, 512, JSON_THROW_ON_ERROR);
        return self::fromArray($serialized);
    }

    public static function fromArray(array $data): Contact
    {
        return new self($data['title'], $data['body']);
    }
}
