<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthorPolicy
{
    public function modify(User $user, Author $author): Response
    {
        return $user->id === $author->user_id
        ? Response::allow()
        : Response::deny('You do not have permission to modify this author.');
    }
}
