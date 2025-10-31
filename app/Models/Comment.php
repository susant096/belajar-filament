<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
