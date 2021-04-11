<?php
declare(strict_types = 1);

namespace Developez\Front\Shared\Infrastructure;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FrontController
{
    public function index(Request $request): View
    {
        return view('index');
    }
}
