<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareHouseBill extends Model
{
    use HasFactory;
    protected $table="ware_house_bills";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'note',
        'total',
        'status',
        "user_id",
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function billItems(){
        return $this->hasMany(WareHouseBillItem::class, 'bill_id');
    }
}