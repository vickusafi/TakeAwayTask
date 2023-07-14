<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'flight_id';

    //list roles i.e teacher, student etc
    public function getUserRoles()
    {
        $roles = Role::select('id', 'name')->where('status', '1')->get();
        if (!empty($roles)) {
            return $roles;
        }
        return [];
    }
}
