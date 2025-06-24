<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    //fillable ile hangi alanlar post edilebilecek
    protected $fillable = [
        'title',
        'body',
    ];
     
    //belongsTo ile postun hangi kullanıcıya ait olduğunu belirler.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
