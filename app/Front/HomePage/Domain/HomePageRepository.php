<?php

declare(strict_types = 1);

namespace Developez\Front\HomePage\Domain;

interface HomePageRepository
{
    public function getHomePagePage(): ?HomePage;
}
