<?php

declare(strict_types = 1);

namespace Developez\Front\AboutUs\Infrastructure;

use Developez\Front\AboutUs\Domain\AboutUs;
use Developez\Front\AboutUs\Domain\AboutUsRepository;
use Illuminate\Support\Facades\DB;

final class EloquentAboutUsRepository implements AboutUsRepository
{
    public function getAboutUsPage(): ?AboutUs
    {
        $page = DB::table('pages')
            ->where('type', AboutUs::PAGE)
            ->first();

        if (null === $page) {
            return null;
        }

        return AboutUs::fromArray((array) $page);
    }

    public function createAboutPage(AboutUs $aboutUs): AboutUs
    {
        DB::table('pages')->insert($aboutUs->toArray());

        return $aboutUs;
    }
}
