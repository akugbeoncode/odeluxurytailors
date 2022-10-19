<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SmsSetting extends Model
{
    use HasFactory;

    protected $table = 'sms_settings';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public static function getSmsTemplate($template_name) {
        return static::where('name', $template_name)->first();
    }

    public function parseMessage($data) {
        $matches = [];

        preg_match_all("/#([a-z][a-zA-Z]\w+)/", $this->message, $matches);

        if (empty($matches)) {
            return $this->message;
        }

        $parameters = $data["sms_info"];
        $message = $this->message;

        foreach ($matches[1] as $p) {
            if (isset($parameters->{$p})) {
                $message = str_replace("#{$p}", $parameters->{$p}, $message);
            }
        }

        return $message;
    }

    public function getParametersAttribute($parameters) {
        if (!preg_match('/,/', $parameters)) {
            return [$parameters];
        }

        return explode(',', $parameters);
    }
}
