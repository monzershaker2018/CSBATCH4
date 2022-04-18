<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $guarded = [];


    // relation between levels and sections
    public function Sections()
    {
        return $this->belongsTo( Section::class , 'section_id' , 'id');
    }

    // relation between levels and Semesters
    public function Semesters()
    {
        return $this->hasMany(Semester::class);
    }
}
