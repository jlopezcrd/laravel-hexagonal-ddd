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
                Str::slug('Mural 1'),
                'Mural 1',
                '/gallery/img/murales/1.jpg',
                'MURALES',
                1,
                1,
                1,
                500.0
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('Cuadro 1'),
                'Cuadro 1',
                '/gallery/img/cuadros/1.jpg',
                'CUADROS',
                0,
                1,
                1,
                800.00
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('Lienzo 1'),
                'Lienzo 1',
                '/gallery/img/lienzos/1.jpg',
                'LIENZOS',
                1,
                1,
                1,
                300.0
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
