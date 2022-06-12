<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table="orders";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'ship_address',
        'note',
        'fullName',
        'phone',
        'email',
        'total',
        "user_id",
        "creator_id"
    ];

    public function creator(){
        return $this->belongsTo(User::class,'creator_id');
    }

    public function customer(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}