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

            $imap_settings = DB::table('settings')->where('type', 'imap')->pluck('description', 'label');
            if (!$imap_settings->isEmpty()) {
                json_decode($smtp_settings['from']);
                $smtp_config = [
                    'ImapHost' => $smtp_settings['imap_host'],
                    'ImapPort' => $smtp_settings['imap_port'],
                    'ImapEncryption' => $smtp_settings['imap_encryption'],
                    'ImapUser' => $smtp_settings['imap_user'],
                    'ImapPass' => $smtp_settings['imap_pass'],
                    'ImapSentFolder' => $smtp_settings['imap_sent_folder'],
                ];
                config(['mail.imap' => $smtp_config]);
            }

            $email_settings = DB::table('settings')->where('type', 'email')->pluck('description', 'label');
            if (!$email_settings->isEmpty()) {
                $email_config = [
                    'bank' => $email_settings['bank'] ?? '',
                    'branch' => $email_settings['branch'] ?? '',
                    'acc_number' => $email_settings['acc_number'] ?? '',
                    'acc_name' => $email_settings['acc_name'] ?? '',

                    'nostro_1_bank' => $email_settings['nostro_1_bank'] ?? '',
                    'nostro_1_branch' => $email_settings['nostro_1_branch'] ?? '',
                    'nostro_1_acc_number' => $email_settings['nostro_1_acc_number'] ?? '',
                    'nostro_1_acc_name' => $email_settings['nostro_1_acc_name'] ?? '',

                    'nostro_2_bank' => $email_settings['nostro_2_bank'] ?? '',
                    'nostro_2_branch' => $email_settings['nostro_2_branch'] ?? '',
                    'nostro_2_acc_number' => $email_settings['nostro_2_acc_number'] ?? '',
                    'nostro_2_acc_name' => $email_settings['nostro_2_acc_name'] ?? '',

                    'ecco_number' => $email_settings['ecco_number'] ?? '',
                    'ecco_name' => $email_settings['ecco_name'] ?? '',

                    'show_eco' => $email_settings['show_eco'] ?? '',
                    'show_bank' => $email_settings['show_bank'] ?? '',
                    'show_nostro_1' => $email_settings['show_nostro_1'] ?? '',
                    'show_nostro_2' => $email_settings['show_nostro_2'] ?? '',

                ];
                config(['config.EMAIL' => $email_config]);
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
