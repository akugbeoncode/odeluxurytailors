<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user() {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public static function getAllRolesExceptSuperUser() {
        return static::where('id', '<>', 1)->get();
    }

    public static function getUserRole($role) {
        $roles = static::where('title', 'like', '%' . $role . '%')->get();
        $ids = null;
        if (count($roles) == 1) {
            $ids = $roles[0]->id;
        } else {
            $ids = array();
            foreach($roles as $role) {
                array_push($ids, $role->id);
            }
        }
        return $ids;
    }
}
