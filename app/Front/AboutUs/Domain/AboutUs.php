<?php

declare(strict_types = 1);

namespace Developez\Front\AboutUs\Domain;

final class AboutUs
{
    public const PAGE = 'about_us';

    protected $title;
    protected $body;

    public function __construct(string $title, string $body)
    {
        $this->title = $title;
        $this->body  = $body;
    }

    public static function fromJson(string $serialized): AboutUs
    {
        $serialized = json_decode($serialized, true, 512, JSON_THROW_ON_ERROR);
        return self::fromArray($serialized);
    }

    public static function fromArray(array $data): AboutUs
    {
        return new self($data['title'], $data['body']);
    }
}
