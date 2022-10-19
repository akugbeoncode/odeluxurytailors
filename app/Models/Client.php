<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Client extends Model
{
  use Uuid, HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function transactions() {
      return $this->hasMany(Transaction::class, 'client_id', 'id');
    }

    public function gender() {
      return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }

    public function measurement () {
      return $this->hasOne(ClientMeasurement::class, 'client_id', 'id');
    }

    public static function hasMeasurement () {
      $measurement = static::measurement();
      if ($measurement->isNotEmpty()) {
        return true;
      }
      return false;
    }

    public static function getClientById($id) {
      return static::find($id);
    }

    public static function getClientByEmail($email) {
      return static::where('email', $email)->get();
    }

    public static function getClientByPhone($phone) {
      return static::where('phone', $phone)->get();
    }

    public static function getClientsByDateRange($startDate, $endDate) {
      if ($startDate == $endDate) {
        return static::where('created_at', $startDate)->get();
      }
      return static::whereBetween('created_at', [$startDate, $endDate])->get();
    }

    public static function getClients() {
      return static::all();
    }
}
