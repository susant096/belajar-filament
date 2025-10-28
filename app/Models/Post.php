<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'slug', 'thumbnail', 'user_id'];

    protected static function booted()
    {
        static::creating(function ($post) {
            $slug = Str::slug($post->title);
            $originalSlug = $slug;
            $count = 1;
            // cek duplikasi slug
            while (static::where('slug', $slug)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
            $post->slug = $slug;
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $slug = Str::slug($post->title);
                $originalSlug = $slug;
                $count = 1;

                while (
                    static::where('slug', $slug)
                        ->where('id', '!=', $post->id)
                        ->exists()
                ) {
                    $slug = "{$originalSlug}-{$count}";
                    $count++;
                }

                $post->slug = $slug;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
