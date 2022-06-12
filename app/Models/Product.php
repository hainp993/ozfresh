<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table="products";
    protected $fillable = ["name","thumbnail","slug","description","sale","price","quantity","sell_number","user_id ", "author_id" , "publisher_id"];


    public function categories()
    {
        return $this->belongsToMany(Productcategory::class, 'products_categories', 'product_id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_images');
    }

}
