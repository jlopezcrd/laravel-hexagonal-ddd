<?php

declare(strict_types = 1);

namespace Developez\Front\Product\Domain;

use Developez\Shared\Domain\Serializable;

final class Product implements Serializable
{
    protected $uuid;
    protected $slug;
    protected $name;
    protected $image;
    protected $category;
    protected $is_painting;
    protected $on_gallery;
    protected $on_shop;
    protected $price;

    public function __construct(
        string $uuid,
        string $slug,
        string $name,
        string $image,
        string $category,
        bool $is_painting = true,
        bool $on_gallery = true,
        bool $on_shop = true,
        float $price = 0.0
    ) {
        $this->uuid = $uuid;
        $this->slug = $slug;
        $this->name = strtoupper($name);
        $this->image = $image;
        $this->category = strtoupper($category);
        $this->is_painting = $is_painting;
        $this->on_gallery = $on_gallery;
        $this->on_shop = $on_shop;
        $this->price = $price;
    }

    public static function fromJson(string $serialized): Product
    {
        $serialized = json_decode($serialized, true, 512, JSON_THROW_ON_ERROR);
        return self::fromArray($serialized);
    }

    public static function fromArray(array $data): Product
    {
        return new self(
            $data['uuid'],
            $data['slug'],
            $data['name'],
            $data['image'],
            $data['category'],
            (bool)$data['is_painting'],
            (bool)$data['on_gallery'],
            (bool)$data['on_shop'],
            (float)$data['price']
        );
    }

    public function id(): string
    {
        return $this->uuid;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function slug(): string
    {
        return route('gallery_detail', [$this->category(), $this->slug]);
    }

    public function category(): string
    {
        return $this->category;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function is_painting(): bool
    {
        return $this->is_painting;
    }

    public function on_gallery(): bool
    {
        return $this->on_gallery;
    }

    public function on_shop(): bool
    {
        return $this->on_shop;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid,
            'slug' => $this->slug,
            'name' => $this->name,
            'image' => $this->image,
            'category' => $this->category,
            'is_painting' => $this->is_painting,
            'on_gallery' => $this->on_gallery,
            'on_shop' => $this->on_shop,
            'price' => $this->price
        ];
    }
}
