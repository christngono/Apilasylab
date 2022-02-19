<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function classe(){
        return $this->belongsTo(Classe::class);
    }

    public function course(){
        return $this->hasMany(Course::class);
    }
}
