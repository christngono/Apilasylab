<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
            'title',
            'introduction',
            'rappel',
            'subtitle',
            'astuce',
            'exemple',
            'attention',
            'conclusion',
            'course_id',
            'topimage',
            'bottomimage'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function quiz(){
        return $this->hasMany(Quiz::class);
    }
}
