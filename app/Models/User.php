<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class User extends Authenticatable implements JWTSubject
{
    use Uuid, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
      return [];
    }

    public function role() {
      return $this->belongsTo(UserRole::class, "role_id", "id");
    }

    public function country() {
      return $this->belongsTo(Country::class, "country_id", "id");
    }

    public function state() {
      return $this->belongsTo(State::class, "state_id", "id");
    }

    public function city() {
      return $this->belongsTo(City::class, "city_id", "id");
    }

    public function gender() {
      return $this->belongsTo(Gender::class, "gender_id", "id");
    }

    public function guarantors() {
      return $this->hasMany(UserGuarantor::class, 'user_id', 'id');
    }

    public static function getAllManagerGradeEmployees() {
      return static::where('role_id', '<=', 4)->get();
    }

    public static function getAllEmployeesExceptSuperUser($role) {
      // $output = new ConsoleOutput();
      if ($role != '') {
        $ids = UserRole::getUserRole($role);
        if (is_array($ids)) {
          $result = new Collection();
          foreach ($ids as $index => $id) {
            $result = $result->merge(static::where('role_id', $id)->get());
          }
          return $result;
        } else {
          return static::where('role_id', $ids)->get();
        }
      } else {
        return static::where('role_id', '<>', 1)->get();
      }
    }

    public static function getNewEmployeeID() {
      return 'OLTs-' . time();
    }
}
