<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user() {
        return $this->hasMany(User::class, 'city_id', 'id');
    }
}
