<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','file','views','course_id','description','title','likes','dislikes'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
