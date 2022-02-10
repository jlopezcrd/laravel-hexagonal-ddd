<?php

declare(strict_types = 1);

namespace Developez\Front\AboutUs\Application;

use Developez\Front\AboutUs\Domain\AboutUs;
use Developez\Front\AboutUs\Domain\AboutUsRepository;
use Developez\Shared\Domain\NotFoundException;

final class AboutUsFinder
{
    private $repository;

    public function __construct(AboutUsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): AboutUs
    {
        $aboutUs = $this->repository->getAboutUsPage();

        if (null === $aboutUs) {
            throw new NotFoundException('About Us Page not found!');
        }

        return $aboutUs;
    }
}
