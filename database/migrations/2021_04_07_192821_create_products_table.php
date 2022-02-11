<?php

use Developez\Front\Product\Domain\Product;
use Developez\Front\Product\Domain\ProductRepository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateProductsTable extends Migration
{
    protected $repository;

    public function __construct()
    {
        $this->repository = resolve(ProductRepository::class);
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->index();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('image');
            $table->string('category');
            $table->boolean('is_painting')->default(0);
            $table->boolean('on_gallery')->default(1);
            $table->boolean('on_shop')->default(0);
            $table->float('price')->default(0.0);
            $table->timestamps();
        });

        $products = [
            new Product(
                Str::uuid()->toString(),
                Str::slug('BITCOINS'),
                'Bitcoins',
                '/gallery/img/bitcoin.jpg',
                'CRYPTO_CURRENCY',
                0,
                1,
                1,
                500.0
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('EUROS'),
                'Euros',
                '/gallery/img/euro.jpg',
                'FIAT_CURRENCY',
                0,
                1,
                1,
                800.00
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('DOLLARS'),
                'Dollars',
                '/gallery/img/dollar.jpg',
                'FIAT_CURRENCY',
                0,
                0,
                0,
                800.00
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('MONKEY'),
                'Bored Ape Yatch Club',
                '/gallery/img/monkey.jpg',
                'NFT_CURRENCY',
                1,
                1,
                0,
                300.0
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('JUVENTUS'),
                'Juventus FAN Token',
                '/gallery/img/juventus.jpg',
                'ETHER_TOKEN',
                1,
                1,
                0,
                100.0
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('Test'),
                'TEST',
                '/gallery/img/test.jpg',
                'TEST_CURRENCY',
                1,
                1,
                1,
                -1
            ),
        ];

        foreach($products as $product) {
            $this->repository->saveProduct($product);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
