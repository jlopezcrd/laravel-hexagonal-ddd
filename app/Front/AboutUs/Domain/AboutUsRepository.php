<?php

declare(strict_types = 1);

namespace Developez\Front\AboutUs\Domain;

interface AboutUsRepository
{
    public function getAboutUsPage(): ?AboutUs;
}
