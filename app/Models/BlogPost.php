<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $table="blog_posts";
    protected $fillable = ["title","thumbnail","content","slug","description","status", "user_id"];


    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_posts_categories', 'post_id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
