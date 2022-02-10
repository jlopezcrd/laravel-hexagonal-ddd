<?php

declare(strict_types = 1);

namespace Developez\Front\HomePage\Application;

use Developez\Front\HomePage\Domain\HomePage;
use Developez\Front\HomePage\Domain\HomePageRepository;
use Developez\Shared\Domain\NotFoundException;

final class HomePageFinder
{
    private $repository;

    public function __construct(HomePageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): HomePage
    {
        $aboutUs = $this->repository->getHomePagePage();

        if (null === $aboutUs) {
            throw new NotFoundException('About Us Page not found!');
        }

        return $aboutUs;
    }
}
