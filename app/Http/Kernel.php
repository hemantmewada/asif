<?php

namespace App\Http;

use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        'role' => EnsureUserHasRole::class,
    ];
}
