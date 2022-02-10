<?php

use Developez\Front\AboutUs\Domain\AboutUs;
use Developez\Front\AboutUs\Domain\AboutUsRepository;
use Developez\Front\HomePage\Domain\HomePage;
use Developez\Front\HomePage\Domain\HomePageRepository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    protected $repository;

    public function __construct()
    {
        $this->repository = resolve(AboutUsRepository::class);
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->json('body');
            $table->timestamps();
        });

        (resolve(HomePageRepository::class))->createAboutPage(
            new HomePage(HomePage::PAGE, 'Home Page', (object) [
                'head' => "<h2>Hi Home page!</h2>",
                'body' => "<p>Home Body</p>",
            ])
        );

        $this->repository->createAboutPage(
            new AboutUs(AboutUs::PAGE, 'About Us', (object) [
                'head' => "<h2>Hi About us!</h2>",
                'body' => "<p>About body</p>",
            ])
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
