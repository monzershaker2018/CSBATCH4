<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Attachment extends Model
{
    use HasFactory;


    protected $guarded = [];


    // relation between semesters and sections
    public function Subjects()
    {
        return $this->belongsTo( Subject::class , 'subject_id' , 'id');
    }
}
