<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Semester;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];


// relation between and semesters
     public function Semesters()
     {
         return $this->hasMany(Semester::class);
     }

     // relation between and semesters
     public function Subjects()
     {
         return $this->hasMany(Subject::class);
     }

}
