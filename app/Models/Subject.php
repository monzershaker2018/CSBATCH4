<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];

     // relation between semesters and sections
     public function Semesters()
     {
         return $this->belongsTo(Semester::class , 'semester_id' , 'id');
     }

       // relation between semesters and sections
    public function Sections()
    {
        return $this->belongsTo( Section::class , 'section_id' , 'id' );
    }

      // relation between Subject and attechments
    public function Attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
