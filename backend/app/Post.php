<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Comment;

class Post extends Model
{
    use HasFactory;

    // Set mass-assignable fields
    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * Get the comments for the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
