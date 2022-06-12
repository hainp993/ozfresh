<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table="table_author";
    protected $fillable = ["name","description"];

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_posts_categories', 'category_id', 'post_id');
    }

}
