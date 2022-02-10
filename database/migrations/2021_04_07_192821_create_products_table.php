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
            $table->string('size');
            $table->string('description');
            $table->string('image');
            $table->string('category');
            $table->string('subcategory')->default('test');
            $table->boolean('is_painting')->default(0);
            $table->boolean('on_gallery')->default(1);
            $table->boolean('on_shop')->default(0);
            $table->timestamps();
        });

        $murals = [
            '/gallery/img/murales/1.jpg',
            '/gallery/img/murales/2.jpg',
            '/gallery/img/murales/3.jpg',
            '/gallery/img/murales/4.jpg',
            '/gallery/img/murales/5.jpg',
            '/gallery/img/murales/6.jpg',
            '/gallery/img/murales/7.jpg',
            '/gallery/img/murales/8.jpg',
            '/gallery/img/murales/9.jpg',
            '/gallery/img/murales/10.jpg',
            '/gallery/img/murales/11.jpg',
            '/gallery/img/murales/12.jpg'
        ];

        foreach($murals as $keyId => $image) {
            $product = new Product(
                Str::uuid()->toString(),
                Str::slug('Producto ' . ($keyId + 1)),
                'Producto ' . ($keyId + 1),
                '',
                '',
                $image,
                'MURALES',
                1,
                1
            );
            $this->repository->saveProduct($product);
        }

        $cuadros = [
            new Product(
                Str::uuid()->toString(),
                Str::slug('ARTURITO'),
                'ARTURITO',
                '162x130',
                'óleo sobre tela',
                '/gallery/img/cuadros/1.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('ANDRÉS'),
                'ANDRÉS',
                '(en proceso)',
                'pastel sobre papel',
                '/gallery/img/cuadros/2.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('Nata'),
                'Nata',
                '146x114',
                'óleo sobre tela',
                '/gallery/img/cuadros/3.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('SANGRE VEGANA'),
                'SANGRE VEGANA',
                '162x114',
                'óleo sobre tela',
                '/gallery/img/cuadros/4.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('IAIA MARINA'),
                'IAIA MARINA',
                '',
                'pastel sobre tela',
                '/gallery/img/cuadros/5.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('MAMASITA'),
                'MAMASITA',
                '146x114',
                'óleo sobre tela',
                '/gallery/img/cuadros/6.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('ANDRÉS2'),
                'ANDRÉS',
                '',
                'pastel sobre papel',
                '/gallery/img/cuadros/7.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('MBAKA'),
                'MBAKA',
                '162x114',
                '(en proceso) óleo sobre papel',
                '/gallery/img/cuadros/8.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('MBAKA2'),
                'MBAKA',
                '162x114',
                '(en proceso) óleo sobre papel',
                '/gallery/img/cuadros/9.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('AUTORRETRATOS'),
                'AUTORRETRATOS',
                '',
                'óleo sobre papel',
                '/gallery/img/cuadros/10.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('noname'),
                '',
                '',
                '',
                '/gallery/img/cuadros/11.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('IAIO JAUME'),
                'IAIO JAUME',
                '',
                'óleo sobre papel',
                '/gallery/img/cuadros/12.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('IAIA MARI'),
                'IAIA MARI',
                '',
                '(en proceso) pastel sobre papel',
                '/gallery/img/cuadros/13.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('AUTORETRATO2'),
                'AUTORETRATO',
                '146x114',
                '(en proceso) óleo sobre papel',
                '/gallery/img/cuadros/14.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('sangre vegana2'),
                'sangre vegana',
                '162x114',
                '(en proceso) óleo sobre papel',
                '/gallery/img/cuadros/15.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('pau'),
                'pau',
                '162x114',
                '(en proceso) óleo sobre papel',
                '/gallery/img/cuadros/16.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('hombre perro'),
                'hombre perro',
                '162x114',
                '(en proceso) óleo sobre papel',
                '/gallery/img/cuadros/17.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('julia'),
                'julia',
                '162x114',
                '(en proceso) óleo sobre papel',
                '/gallery/img/cuadros/18.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('noname2'),
                '',
                '',
                '',
                '/gallery/img/cuadros/19.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('noname3'),
                '',
                '',
                '',
                '/gallery/img/cuadros/20.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('retrato waor'),
                'retrato waor',
                '162x130',
                'óleo sobre papel',
                '/gallery/img/cuadros/21.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('el confinamiento'),
                'el confinamiento',
                '162x114',
                'óleo sobre papel',
                '/gallery/img/cuadros/22.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('Ayax'),
                'Ayax',
                '146x114',
                'óleo sobre papel',
                '/gallery/img/cuadros/23.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('autorretrato3'),
                'autorretrato',
                '146x114',
                'óleo sobre papel',
                '/gallery/img/cuadros/24.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('el día de la marmota'),
                'el día de la marmota',
                '',
                'óleo sobre papel',
                '/gallery/img/cuadros/25.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('paula'),
                'paula',
                '162x130',
                'óleo sobre papel',
                '/gallery/img/cuadros/26.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('noname4'),
                '',
                '',
                '',
                '/gallery/img/cuadros/27.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('los comedores de patatas'),
                'los comedores de patatas',
                '162x130',
                'óleo sobre papel',
                '/gallery/img/cuadros/28.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('blon'),
                'blon',
                '146x114',
                'óleo sobre papel',
                '/gallery/img/cuadros/29.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('el lago de los cisnes'),
                'el lago de los cisnes',
                '162x130',
                'óleo sobre papel',
                '/gallery/img/cuadros/30.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('noname5'),
                '',
                '',
                '',
                '/gallery/img/cuadros/31.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('el triunfo de baco'),
                'el triunfo de baco',
                '162x130',
                'óleo sobre papel',
                '/gallery/img/cuadros/32.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('los asuntos de brujas'),
                'los asuntos de brujas',
                '162x130',
                'óleo sobre papel',
                '/gallery/img/cuadros/33.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('noname6'),
                '',
                '',
                '',
                '/gallery/img/cuadros/34.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('la bañera'),
                'la bañera',
                '146x114',
                'óleo sobre papel',
                '/gallery/img/cuadros/35.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('orfeo en los infiernos'),
                'orfeo en los infiernos',
                '162x130',
                '(en proceso) óleo sobre papel',
                '/gallery/img/cuadros/36.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('orfeo en los infiernos2'),
                'orfeo en los infiernos',
                '163x130',
                'óleo sobre papel',
                '/gallery/img/cuadros/37.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('desayuno en la barceloneta'),
                'desayuno en la barceloneta',
                '162x140',
                'óleo sobre papel',
                '/gallery/img/cuadros/38.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('la industria al retrete'),
                'la industria al retrete',
                '162x130',
                'óleo sobre papel',
                '/gallery/img/cuadros/39.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('marcela'),
                'marcela',
                '',
                'óleo sobre papel',
                '/gallery/img/cuadros/40.jpg',
                'CUADROS',
                1,
                1
            ),
            new Product(
                Str::uuid()->toString(),
                Str::slug('arturito2'),
                'arturito',
                '146x114',
                '(en proceso) óleo sobre papel',
                '/gallery/img/cuadros/41.jpg',
                'CUADROS',
                1,
                1
            ),
        ];

        foreach($cuadros as $product) {
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
