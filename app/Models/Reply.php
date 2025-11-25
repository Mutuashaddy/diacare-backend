<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
           protected $table =  'replies';
           
    protected $fillable = [
        'user_id',
        'post_id',
        'reply_text',
    ];

    /**
     * A reply belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A reply belongs to a post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
