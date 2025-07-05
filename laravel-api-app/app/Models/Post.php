<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
     
    //post modelindeki fillable property'si ile hangi field'larin database'e kaydedilecegini belirliyoruz.
    protected $fillable = [
        'title',
        'body',
    ];
    //post modelindeki user property'si ile user tablosundaki user_id field'ini ilişkilendiriyoruz.
    public function user(){
        return $this->belongsTo(User::class);
    }
}
