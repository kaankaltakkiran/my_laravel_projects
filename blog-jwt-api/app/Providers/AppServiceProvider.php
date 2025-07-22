<?php

namespace App\Providers;

use App\Models\Blog;
use App\Policies\BlogPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Blog::class => BlogPolicy::class,
    ];
}
