<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','content','date','user_id','receiver','date'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
