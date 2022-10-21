<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class SendEmailHelper
{

    public static function sendEmail($email, $subject, $title, $content, $attachment)
    {
            Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message) use ($attachment, $email, $subject) {
                $email = str_replace(' ', '', $email);
                $receipients = explode(',', $email);
                $message->to($receipients);
                $message->subject($subject);
                if ($attachment !== null) {
                    $message->attach($attachment->path, ['mime' => 'pdf']);
                }

                
            });

            SendEmailHelper::saveToOutbox($email, $subject, $attachment, $title, $content);
   
    }

    private static function saveToOutbox($email, $sub, $attachment, $title, $content)
    {
        $IMAPhost = \config('mail.imap.ImapHost');
        // IMAP port 143, 995 or POP3 port 110, 995
        $IMAPport = \config('mail.imap.ImapPort');
        $IMAPssl = \config('mail.imap.ImapEncryption');
        $IMAP = '{' . $IMAPhost . ':' . $IMAPport . '/imap/' . $IMAPssl . '/novalidate-cert}';
        $IMAPuser = \config('mail.imap.ImapUser');
        $IMAPass = \config('mail.imap.ImapPass');
        $msg = view('emails.send')->with(['title' => $title, 'content' => $content]);
        // imap email and password
        $ibox = imap_open($IMAP, $IMAPuser, $IMAPass);
        $dmy = date("Y-m-d H:i:s");
        // pack file contents
        $attach = chunk_split(base64_encode(file_get_contents(asset($attachment->path))));
        $boundary = "------=" . md5(uniqid(rand()));
        imap_append($ibox, $IMAP . \config('mail.imap.ImapSentFolder')
            , "From: <" . $IMAPuser . ">\r\n"
            . "To: " . $email . "\r\n"
            . "Date: $dmy\r\n"
            . "Subject: " . $sub . "\r\n"
            . "MIME-Version: 1.0\r\n"
            . "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"
            . "\r\n\r\n"
            . "--$boundary\r\n"
            . "Content-Type: text/html;\r\n\tcharset=\"utf-8\"\r\n"
            . "Content-Transfer-Encoding: 8bit \r\n"
            . "\r\n\r\n"
            . html_entity_decode($msg) . "\r\n"
            . "\r\n\r\n"
            . "--$boundary\r\n"
            . "Content-Transfer-Encoding: base64\r\n"
            . "Content-Disposition: attachment; filename=\"$attachment->filename\"\r\n"
            . "\r\n" . $attach . "\r\n"
            . "\r\n\r\n\r\n"
            . "--$boundary--\r\n\r\n"
        );
    }
}
