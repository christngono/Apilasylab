<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','createdAt','view','subject_id','type'
    ];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function resume(){
        return $this->hasMany(Resume::class);
    }

    public function videocourse(){
        return $this->hasMany(VideoCourse::class);
    }
}
