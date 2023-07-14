<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $table = 'submission';
    protected $primaryKey = 'id';

    /**
     * Get the submissions associated with the student.
     */
    public function getSubmissions()
    {
        return $this->hasOne(Assignments::class, 'assignment_id', 'id');
    }
}
