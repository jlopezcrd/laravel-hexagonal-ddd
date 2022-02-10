<?php

declare(strict_types = 1);

namespace Developez\Front\HomePage\Domain;

use Developez\Front\Shared\Domain\Page;

final class HomePage implements Page
{
    public const PAGE = 'home_page';

    protected $type;
    protected $title;
    protected $html;

    public function __construct(string $type, string $title, object $body)
    {
        $this->type  = $type;
        $this->title = $title;
        $this->html  = $body;
    }

    public function getHead(): string
    {
        return $this->html->head;
    }

    public function getBody(): string
    {
        return $this->html->body;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    public function toArray(): array
    {
        return [
            'type'  => $this->type,
            'title' => $this->title,
            'body'  => json_encode($this->html, JSON_THROW_ON_ERROR)
        ];
    }

    public static function fromJson(string $serialized): Page
    {
        $serialized = json_decode($serialized, true, 512, JSON_THROW_ON_ERROR);
        return self::fromArray($serialized);
    }

    public static function fromArray(array $data): Page
    {
        return new self(
            $data['type'],
            $data['title'],
            json_decode($data['body'], false, 512, JSON_THROW_ON_ERROR)
        );
    }

    public function isPage(string $page): bool
    {
        return self::PAGE === $page;
    }
}
