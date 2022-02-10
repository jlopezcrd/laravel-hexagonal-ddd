<?php

declare(strict_types = 1);

namespace Developez\Front\Product\Infrastructure;

use Developez\Front\Product\Domain\GalleryCollection;
use Developez\Front\Product\Domain\Product;
use Developez\Front\Product\Domain\ProductRepository;
use Developez\Shared\Domain\Collection;
use Developez\Shared\Domain\Query;
use Illuminate\Support\Facades\DB;

class EloquentProductRepository implements ProductRepository
{
    public function find(string $uuid): ?Product
    {
        $product = DB::table('products')
            ->where('uuid', $uuid)
            ->first();

        if(null === $product) {
            return null;
        }

        return Product::fromArray((array) $product);
    }

    public function findBySlug(string $category, string $slug): ?Product
    {
        $product = DB::table('products')
            ->where('category', $category)
            ->where('slug', $slug)
            ->first();

        if(null === $product) {
            return null;
        }

        return Product::fromArray((array) $product);
    }

    public function search(Query $query): Collection
    {
        //dd($query);
        $this->model = DB::table('products');

        if($query->hasAnd()) {
            $this->model = $this->model->where($query->valueAnd());
        }

        if($query->hasOr()) {
            $this->model = $this->model->where(static function($orm) use ($query) {
                return $orm->orWhere($query->valueOr());
            });
        }

        //dd($this->model->toSql());

        return new Collection(array_map(static function($item) {
            return Product::fromArray((array) $item);
        }, $this->model->get()->toArray()));
    }

    public function findAll(): Collection
    {
        $this->model = DB::table('products');

        return new Collection(array_map(function($item) {
            return Product::fromArray((array) $item);
        }, $this->model->get()->toArray()));
    }

    public function gallery(): GalleryCollection
    {
        $productsDB = DB::table('products')
            ->where('on_gallery', 1)
            ->get();

        $products = array_map(static function($item) {
            return Product::fromArray((array) $item);
        }, $productsDB->toArray());

        $categories = $productsDB->unique('category')
            ->pluck('category')
            ->reverse()
            ->toArray();

        return new GalleryCollection($products, $categories);
    }

    public function saveProduct(Product $product): Product
    {
        DB::table('products')->insert($product->toArray());

        return $product;
    }
}
