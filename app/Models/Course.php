<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = "courses";
    protected $fillable = [
        "title", "thumbnail", "content",
        "slug", "description", "status", "user_id",
        "number_of_hours", "rate", "start_date", "utilities"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
