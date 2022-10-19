<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationAttribute extends Model
{
    use HasFactory;

    public static function getClientName() {
        return "Ode Luxury Tailors";
    }

    public static function getClientLogo() {
        return asset('/images/OLTs_transparent_bg.png');
    }

    public static function getSmsFrom() {
        return "OLTS";
    }

    public static function getNoReplyFromEmail() {
        return 'no-reply@support.odeluxurytailors.com';
    }

    public static function getFromEmail() {
        return 'support@odeluxurytailors.com';
    }
}
