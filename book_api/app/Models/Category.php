<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
