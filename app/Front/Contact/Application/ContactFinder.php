<?php

declare(strict_types = 1);

namespace Developez\Front\Contact\Application;

use Developez\Front\Contact\Domain\Contact;
use Developez\Front\Contact\Domain\ContactRepository;
use Developez\Shared\Domain\NotFoundException;

final class ContactFinder
{
    private $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): Contact
    {
        $aboutUs = $this->repository->getContactPage();

        if(null === $aboutUs) {
            throw new NotFoundException('Contact Page not found!');
        }

        return $aboutUs;
    }
}
