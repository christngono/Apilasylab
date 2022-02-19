<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable=[
        'id','question','a','b','c','d','answer','resume_id'
    ];

    public function resume(){
        return $this->belongsTo(Resume::class);
    }
}
