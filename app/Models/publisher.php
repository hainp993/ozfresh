<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
    protected $table="table_publisher";
    protected $fillable = ["name","description"];

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_posts_categories', 'category_id', 'post_id');
    }

}
