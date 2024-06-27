<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "duty_type_id",
        "date",
        "start",
        "end",
        'remarks',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function duty_type(){
        return $this->belongsTo(Duty_type::class);
    }

}
