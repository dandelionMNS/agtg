<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        'leave_type_id',
        "documents",
        "start",
        "end",
        'reason',
        "status",
    ] ;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function leave_type(){
        return $this->belongsTo(Leave_type::class);
    }
}
