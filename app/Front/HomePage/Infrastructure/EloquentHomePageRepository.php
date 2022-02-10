<?php

declare(strict_types = 1);

namespace Developez\Front\HomePage\Infrastructure;

use Developez\Front\HomePage\Domain\HomePage;
use Developez\Front\HomePage\Domain\HomePageRepository;
use Illuminate\Support\Facades\DB;

final class EloquentHomePageRepository implements HomePageRepository
{
    public function getHomePagePage(): ?HomePage
    {
        $page = DB::table('pages')
            ->where('type', HomePage::PAGE)
            ->first();

        if (null === $page) {
            return null;
        }

        return HomePage::fromArray((array)$page);
    }

    public function createAboutPage(HomePage $aboutUs): HomePage
    {
        DB::table('pages')->insert($aboutUs->toArray());

        return $aboutUs;
    }
}
