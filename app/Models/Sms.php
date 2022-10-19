<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use \Nexmo\Client\Credentials\Basic;
use \Nexmo\Client;

class Sms extends Model
{
    use HasFactory;

    protected $table = 'sms';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'from', 'to', 'message'
    ];

    private static $client_config = [
        'api_key' => '732cc0aa',
        'secret' => '30Wo7iFI2YTMtrZp'
    ];

    private static $sms_config;

    private static $NG_CODE = '234';
    private static $SMS_FAILED = 2;
    private static $SMS_SENT = 3;

    public static function initializeSms($data) {
        static::$sms_config = (object) $data;

        return new Sms();
    }

    private function loadSmsTemplate($template_name, $data) {
        $sms_processing_data = $data;

        $sms_template = $this->loadTextMessage($template_name, $sms_processing_data);

        if (! isset($sms_processing_data['text'])) {
            $sms_processing_data['text'] = $sms_template->message;
        }

        $sms_processing_data["text"] = preg_replace("/[\r]/", " ", $sms_processing_data["text"]);

        $text_message = (object) [
            'text' => $sms_processing_data["text"]
        ];

        return $text_message;
    }

    private function loadTextMessage($name, $data) {
        $sms_template = SmsSetting::getSmsTemplate($name);

        $sms_data = ((object) [
            "message" => isset($sms_template->message) ? $sms_template->parseMessage($data) : null
        ]);

        return $sms_data;
    }

    private function sendSms($from, $to, $text_message) {
        $logged_sms = static::saveSms($from, $to, $text_message);
        return $logged_sms->sendMessage();
    }

    private function saveSms($from, $to, $text_message) {
        $logged_sms = new Sms([
            'from' => $from, 
            'to' =>  $this->preprocessRecipientNumber($to),
            'message' => $text_message->text
        ]);

        $logged_sms->save();

        return $logged_sms;
    }

    private function sendMessage() {
        $basic  = new \Nexmo\Client\Credentials\Basic(static::$client_config['api_key'], static::$client_config['secret']);
        $client = new \Nexmo\Client($basic);

        $response = $client->message()->send([
            'to' => $this->to,
            'from' => $this->from,
            'text' => $this->message
        ]);

        if ($response->data->messages->status == 0) {
            $this->status = static::$SMS_SENT;
        } else {
            $this->status = static::$SMS_FAILED;
        }
        $this->response = strval(json_encode($response->data));
        $this->save();

        return $response;
    }

    private function preprocessRecipientNumber($to) {
        $processed_to = $to;

        if (Str::length($to) == 14 && Str::startsWith($to, '+')) {
            $processed_to = Str::replaceFirst('0', static::$NG_CODE, $to);
            $processed_to = (Str::startsWith($processed_to, static::$NG_CODE)) && (Str::length($processed_to) == 13) ? $processed_to : $to;
        }

        if (Str::length($to) == 11 && Str::startsWith($to, '0')) {
            $processed_to = Str::replaceFirst('0', static::$NG_CODE, $to);
            $processed_to = (Str::startsWith($processed_to, static::$NG_CODE)) && (Str::length($processed_to) == 13) ? $processed_to : $to;
        }

        return $processed_to;
    }

    public function employeeRegistrationDetails() {
        $data = static::$sms_config;
        $message = $this->loadSmsTemplate('administrator_registration', [
            'sms_info' => $data
        ]);
        $from = ApplicationAttribute::getSmsFrom();
        $to = $data->to;
        $response = $this->sendSms($from, $to, $message);
        return $response;
    }

    public function testEmailDetails() {
        $sms_config = static::$sms_config;
        $message = $this->loadSmsTemplate('administrator_registration', [
            'sms_info' => $sms_config,
        ]);
        $from = ApplicationAttribute::getSmsFrom();
        $to = $sms_config->to;
        $response = $this->sendSms($from, $to, $message);
        return $response;
    }
}
