<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $guarded = [];


    // relation between semesters and sections
    public function Sections()
    {
        return $this->belongsTo( Section::class , 'section_id' , 'id');
    }

    // relation between Semester and subjects
    public function Subjects()
    {
        return $this->hasMany(Subject::class);
    }

}
