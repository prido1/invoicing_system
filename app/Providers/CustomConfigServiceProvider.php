<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class CustomConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        if (Schema::hasTable('settings')) {
            $smtp_settings = DB::table('settings')->where('type', 'smtp')->pluck('description', 'label');
            if (!$smtp_settings->isEmpty()) {
                json_decode($smtp_settings['from']); 
                $smtp_config = [
                    'transport' => 'smtp',
                    'host' => $smtp_settings['smtp_host'],
                    'port' => $smtp_settings['smtp_port'],
                    'encryption' => $smtp_settings['smtp_security'],
                    'username' => $smtp_settings['username'],
                    'password' => $smtp_settings['password'],
                    'from' => json_last_error() === JSON_ERROR_NONE ? json_decode($smtp_settings['from'], true) : '',
                    'timeout' => null,
                    'auth_mode' => null,
                ];
                config(['mail.mailers.smtp' => $smtp_config]);
            }

            $email_settings = DB::table('settings')->where('type', 'email')->pluck('description', 'label');
            if (!$email_settings->isEmpty()) {
                $email_config = [
                    'bank' => $email_settings['bank'] ?? '',
                    'branch' => $email_settings['branch'] ?? '',
                    'acc_number' => $email_settings['acc_number'] ?? '',
                    'acc_name' => $email_settings['acc_name'] ?? '',
                    'show_bank' => $email_settings['show_bank'] ?? ''

                ];
                config(['config.EMAIL' => $email_config]);
            }

            $imap_settings = DB::table('settings')->where('type', 'imap')->pluck('description', 'label');
            if (!$imap_settings->isEmpty()) {
                $imap_config = [
                    'ImapHost' => $imap_settings['imap_host'] ?? env('IMAP_HOST'),
                    'ImapPort' => $imap_settings['imap_port'] ?? env('IMAP_PORT'),
                    'ImapUser' => $imap_settings['imap_user'] ?? env('IMAP_USER'),
                    'ImapPass' => $imap_settings['imap_pass'] ?? env('IMAP_PASS'),
                    'ImapSentFolder' => $imap_settings['imap_sent_folder'] ?? env('IMAP_SENTFOLDER'),
                    'ImapEncryption' => $imap_settings['imap_encryption'] ?? env('IMAP_ENCRYPTION'),
                    
                ];
                config(['mail.imap' => $imap_config]);
            }


        }

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
