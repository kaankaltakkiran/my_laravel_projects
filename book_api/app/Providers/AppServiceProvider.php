<?php

namespace App\Providers;

use App\Models\Author;
use App\Policies\AuthorPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Author::class => AuthorPolicy::class,
    ];
}
