<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grading extends Model
{
    use HasFactory;
    protected $table = 'grading';
    protected $primaryKey = 'id';

    //relations 
    /**
     * Get the submissions associated with the student.
     */
    public function getAssignments()
    {
        return $this->hasOne(Assignments::class, 'assignment_id', 'id');
    }
    //relations 
}
