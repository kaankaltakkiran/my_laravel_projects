<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Policies\AuthorPolicy;
use App\Policies\BookPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Author::class => AuthorPolicy::class,
        Category::class => CategoryPolicy::class,
        Book::class => BookPolicy::class,
    ];
}
