<?php

declare(strict_types = 1);

namespace Developez\Front\Contact\Domain;

interface ContactRepository
{
    public function getContactPage(): ?Contact;
}
