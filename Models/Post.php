<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use MongoDB\Laravel\Eloquent\Model; // use this if you are using laravel-mongo package
class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'category', 'content', 'image', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
