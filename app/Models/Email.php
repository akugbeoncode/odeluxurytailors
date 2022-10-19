<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\OLTSMail;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'from', 'to', 'subject', 'message', 'attachments'
    ];

    private static $email_config;

    private static $EMAIL_FAILED = 0;
    private static $EMAIL_SENT = 1;

    public static function initializeEmail($data) {
        static::$email_config = (object) $data;

        return new Email();
    }

    private function loadEmailTemplate($template_name, $data) {
        $email_processing_data = (array) $data['email_info'];
        $cta = (object) (isset($data['call_to_action']) ? $data['call_to_action'] : []);

        $email_template = $this->loadEmailBody($template_name, $email_processing_data);

        if (! isset($email_processing_data["email_body"]) ) {
            $email_processing_data["email_body"] = $email_template->body;
        }

        if (! isset($email_processing_data["subject"]) ) {
            $email_processing_data["subject"] = $email_template->subject;
        }

        $email_processing_data["email_body"] = preg_replace("/[\r]/", "<br />", $email_processing_data["email_body"]);

        $email = [
            "body" => $email_processing_data["email_body"],
            "subject" => $email_processing_data["subject"],
            "cta_link" => null,
            "cta_text" => null
        ];

        if ($cta && isset($cta->cta_link)) {
            $email["cta_link"] = $cta->cta_link;
            $email["cta_text"] = $cta->cta_text;
        }

        return (object) $email;
    }

    private function loadEmailBody($template_name, $data) {
        $email_template = EmailSetting::getEmailTemplate($template_name);

        $email_data = (object) [
            "subject" => isset($email_template->subject) ? $email_template->subject : null,
            "body" => isset($email_template->body) ? $email_template->parseMessage($data) : null
        ];

        return $email_data;
    }

    public function buildContact($name, $email) {
        return "{$name} <{$email}>";
    }

    private function sendEmail($from, $to, $message, $attachments=[]) {
        // $from = $this->buildContact($sender->name, "no-reply@" . $sender->email);
        $logged_email = static::saveEmail($from, $to, $message, $attachments=[]);
        return $logged_email->sendMessage($from, $to, $message, $attachments=[]);
    }

    private function saveEmail($from, $to, $message, $attachments=[]) {
        $logged_email = new Email([
            'from' => "{$from->name} <{$from->email}>",
            'to' => "{$to->name} <{$to->email}>",
            'subject' => $message->subject,
            'message' => $message->body,
            'attachments' => implode(",",$attachments)
        ]);

        $logged_email->save();

        return $logged_email;
    }

    public function sendMessage($from, $to, $message, $attachments=[]) {
        $data = [
            'from' => $from,
            'to' => $to,
            'site_url' => asset('/'),
            'client_name' => ApplicationAttribute::getClientName(),
            'client_logo' => ApplicationAttribute::getClientLogo(),
            'subject' => $message->subject,
            'body' => $message->body,
            'cta_link' => isset($message->cta_link) && $message->cta_link != null ? $message->cta_link : null,
            'cta_text' => isset($message->cta_text) && $message->cta_text != null ? $message->cta_text : null
        ];

        $response = Mail::send('emails.olts_template', compact('data'), function ($m) use($data) {
            $m->from($data['from']->email, $data['from']->name);
            $m->to($data['to']->email, $data['to']->name)->subject($data['subject']);
        });

        if (count(Mail::failures()) > 0) {
            $this->status = static::$EMAIL_FAILED;
        } else {
            $this->status = static::$EMAIL_SENT;
        }
        $this->response = strval(json_encode($response != null ? ((array)$response) : [] ));
        $this->save();

        return $response;
    }

    public function employeeRegistrationDetails() {
        $data = static::$email_config;
        $message = $this->loadEmailTemplate('employee_registration', [
            'email_info' => $data,
            'call_to_action' => $data->call_to_action
        ]);
        $from = $data->from;
        $to = $data->to;
        $response = $this->sendEmail($from, $to, $message, $attachments=[]);
        return $response;
    }

    public function testEmailDetails() {
        $email_config = static::$email_config;
        $message = $this->loadEmailTemplate('employee_registration', [
            'email_info' => $email_config,
            'call_to_action' => $email_config->call_to_action
        ]);

        $data = [
            "message" => $message,
            "email_config" => $email_config
        ];
        
        return $data;
    }
}
