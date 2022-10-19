<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGuarantor extends Model
{
    use HasFactory;

    protected $table = 'user_guarantors';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
