<?php
declare(strict_types = 1);

namespace Developez\Front\Product\Domain;

use Developez\Shared\Domain\Serializable;
use Illuminate\Support\Str;

class Product implements Serializable
{
    private $uuid;
    private $slug;
    private $name;
    private $size;
    private $description;
    private $image;
    private $category;
    private $on_gallery;
    private $on_shop;

    public function __construct(
        string $uuid,
        string $slug,
        string $name,
        string $size,
        string $description,
        string $image,
        string $category,
        bool $on_gallery = true,
        bool $on_shop = true
    )
    {
        $this->uuid        = $uuid;
        $this->slug        = $slug;
        $this->name        = strtoupper($name);
        $this->size        = $size;
        $this->description = $description;
        $this->image       = $image;
        $this->category    = strtoupper($category);
        $this->on_gallery  = $on_gallery;
        $this->on_shop     = $on_shop;
    }

    public static function fake(string $uuid = null): Product
    {
        if (!$uuid) {
            $uuid = Str::uuid()->toString(); //TODO UUID DOMAIN GENERATOR
        }

        return new self(
            $uuid,
            'test1',
            'TITULO AQUI',
            '100x100',
            'SIN DESCRIPCION',
            'image.jpg',
            'cuadros',
            $on_gallery = true,
            $on_shop = true
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

    public function name(): string
    {
        return $this->name;
    }

    public function size(): string
    {
        return $this->size;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function thumbnail(): string
    {
        return str_replace('/img/', '/thumbs/', $this->image);
    }

    public function category(): string
    {
        return $this->category;
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
        return 0.0;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    public function toArray(): array
    {
        return [
            'uuid'        => $this->uuid,
            'slug'        => $this->slug,
            'name'        => $this->name,
            'size'        => $this->size,
            'description' => $this->description,
            'image'       => $this->image,
            'category'    => $this->category,
            'on_gallery'  => $this->on_gallery,
            'on_shop'     => $this->on_shop,
        ];
    }

    public static function fromJson(string $serialized): Product
    {
        $serialized = json_decode($serialized, true, 512, JSON_THROW_ON_ERROR);
        return self::fromArray($serialized);
    }

    public static function fromArray(array $data): Product
    {
        return new self($data['uuid'], $data['slug'], $data['name'], $data['size'], $data['description'], $data['image'], $data['category'], (bool) $data['on_gallery'], (bool) $data['on_shop']);
    }
}
