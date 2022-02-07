<?php

declare(strict_types = 1);

namespace Developez\Front\Contact\Infrastructure;

use Developez\Front\Contact\Domain\Contact;
use Developez\Front\Contact\Domain\ContactRepository;
use Illuminate\Support\Facades\DB;

final class EloquentContactRepository implements ContactRepository
{
    public function getContactPage(): ?Contact
    {
        $page = DB::table('pages')->where('type', Contact::PAGE)->first();

        if (null === $page) {
            return null;
        }

        return Contact::fromArray((array) $page);
    }
}
