<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "duty",
        "date",
        "attendance",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
