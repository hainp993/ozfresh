<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table="product_categories";
    protected $fillable = ["name","slug","description","parent_id"];

    public function parent()
    {
        return $this->belongsTo('ProductCategory', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
    

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_categories', 'category_id', 'product_id');
    }

  

}
