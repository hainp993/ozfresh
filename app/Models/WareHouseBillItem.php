<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareHouseBillItem extends Model
{
    use HasFactory;
    protected $table="ware_house_bill_items";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'note',
        "product_id",
        "bill_id",
        'quantity',
        'amount',
    ];

    public function bill(){
        return $this->belongsTo(WareHouseBill::class,'bill_id');
    }
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
}