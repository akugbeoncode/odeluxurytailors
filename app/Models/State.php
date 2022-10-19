<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user() {
        return $this->hasMany(User::class, 'state_id', 'id');
    }
}
