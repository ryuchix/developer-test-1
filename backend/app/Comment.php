<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Post;
use App\User;

class Comment extends Model
{
    use HasFactory;

    // Set mass-assignable fields
    protected $fillable = ['post_id', 'user_id', 'comment'];

    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
