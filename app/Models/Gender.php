<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $table = 'genders';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user() {
        return $this->hasMany(User::class, 'gender_id', 'id');
    }
}
