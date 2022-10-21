<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    public function smtpSettings()
    {
        if (!Gate::allows('list', 'setting')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $settings = Settings::where('type', 'smtp')->pluck('description', 'label');
        return view('modules.settings.smtp-settings')->with(['settings' => $settings]);
    }

    public function SmtpStore(Request $request)
    {
        if (!Gate::allows('update', 'setting')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $request->validate([
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'smtp_security' => 'required',
            'username' => 'required',
            'address' => 'required',
            'name' => 'required',
        ]);

        try {
            DB::transaction(function () use ($request) {
                Settings::updateOrCreate(
                    [
                        'type' => 'smtp', 'label' => 'smtp_host',
                    ], [
                        'type' => 'smtp', 'label' => 'smtp_host', 'description' => $request->smtp_host,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'smtp', 'label' => 'smtp_port',
                    ], [
                        'type' => 'smtp', 'label' => 'smtp_port', 'description' => $request->smtp_port,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'smtp', 'label' => 'smtp_security',
                    ], [
                        'type' => 'smtp', 'label' => 'smtp_security', 'description' => $request->smtp_security,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'smtp', 'label' => 'username',
                    ], [
                        'type' => 'smtp', 'label' => 'username', 'description' => $request->username,
                    ]
                );

                if ($request->password != null) {
                    Settings::updateOrCreate(
                        [
                            'type' => 'smtp', 'label' => 'password',
                        ], [
                            'type' => 'smtp', 'label' => 'password', 'description' => $request->password,
                        ]
                    );
                }

                Settings::updateOrCreate(
                    [
                        'type' => 'smtp', 'label' => 'from',
                    ], [
                        'type' => 'smtp', 'label' => 'from', 'description' =>
                        ['address' => $request->address,
                            'name' => $request->name],
                    ]
                );
            });
        } catch (\Exception$e) {
            return redirect()->back()->with(['error' => 'Something went wrong!!']);
        }
        return redirect()->back()->with(['success' => 'Settings saved successfullly!!']);

    }

    public function imapSettings()
    {
        if (!Gate::allows('list', 'setting')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $settings = Settings::where('type', 'imap')->pluck('description', 'label');
        return view('modules.settings.imap-settings')->with(['settings' => $settings]);
    }

    public function imapStore(Request $request)
    {
        if (!Gate::allows('update', 'setting')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $request->validate([
            'imap_host' => 'required',
            'imap_port' => 'required',
            'imap_user' => 'required',
            'imap_pass' => 'required',
            'imap_sent_folder' => 'required',
            
        ]);

        try {
            DB::transaction(function () use ($request) {
                Settings::updateOrCreate(
                    [
                        'type' => 'imap', 'label' => 'imap_sent_folder',
                    ], [
                        'type' => 'imap', 'label' => 'imap_sent_folder', 'description' => $request->imap_sent_folder,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'imap', 'label' => 'imap_host',
                    ], [
                        'type' => 'imap', 'label' => 'imap_host', 'description' => $request->imap_host,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'imap', 'label' => 'imap_port',
                    ], [
                        'type' => 'imap', 'label' => 'imap_port', 'description' => $request->imap_port,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'imap', 'label' => 'imap_user',
                    ], [
                        'type' => 'imap', 'label' => 'imap_user', 'description' => $request->imap_user,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'imap', 'label' => 'imap_pass',
                    ], [
                        'type' => 'imap', 'label' => 'imap_pass', 'description' => $request->imap_pass,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'imap', 'label' => 'imap_encryption',
                    ], [
                        'type' => 'imap', 'label' => 'imap_encryption', 'description' => $request->imap_encryption,
                    ]
                );

            });
        } catch (\Exception$e) {
            return redirect()->back()->with(['error' => 'Something went wrong!!']);
        }
        return redirect()->back()->with(['success' => 'Settings saved successfullly!!']);

    }

    public function emailSettings()
    {
        //dd(config('config.EMAIL'));
        if (!Gate::allows('list', 'setting')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $settings = Settings::where('type', 'email')->pluck('description', 'label');
        return view('modules.settings.email-settings')->with(['settings' => $settings]);
    }

    public function storeEmailSettings(Request $request)
    {
        if (!Gate::allows('update', 'setting')) {
            return response()->json(['message' => 'not authorized'], 403);
        }

        try {
            DB::transaction(function () use ($request) {
                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'bank',
                    ], [
                        'type' => 'email', 'label' => 'bank', 'description' => $request->bank,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'branch',
                    ], [
                        'type' => 'email', 'label' => 'branch', 'description' => $request->branch,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'acc_number',
                    ], [
                        'type' => 'email', 'label' => 'acc_number', 'description' => $request->acc_number,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'acc_name',
                    ], [
                        'type' => 'email', 'label' => 'acc_name', 'description' => $request->acc_name,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'ecco_number',
                    ], [
                        'type' => 'email', 'label' => 'ecco_number', 'description' => $request->ecco_number,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'ecco_name',
                    ], [
                        'type' => 'email', 'label' => 'ecco_name', 'description' => $request->ecco_name,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'show_eco',
                    ], [
                        'type' => 'email', 'label' => 'show_eco', 'description' => $request->show_eco ? 1 : 0,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'show_bank',
                    ], [
                        'type' => 'email', 'label' => 'show_bank', 'description' => $request->show_bank ? 1 : 0,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'show_nostro_1',
                    ], [
                        'type' => 'email', 'label' => 'show_nostro_1', 'description' => $request->show_nostro_1 ? 1 : 0,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'show_nostro_2',
                    ], [
                        'type' => 'email', 'label' => 'show_nostro_2', 'description' => $request->show_nostro_2 ? 1 : 0,
                    ]
                );
                //nostro1
                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'nostro_1_bank',
                    ], [
                        'type' => 'email', 'label' => 'nostro_1_bank', 'description' => $request->nostro_1_bank,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'nostro_1_branch',
                    ], [
                        'type' => 'email', 'label' => 'nostro_1_branch', 'description' => $request->nostro_1_branch,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'nostro_1_acc_number',
                    ], [
                        'type' => 'email', 'label' => 'nostro_1_acc_number', 'description' => $request->nostro_1_acc_number,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'nostro_1_acc_name',
                    ], [
                        'type' => 'email', 'label' => 'nostro_1_acc_name', 'description' => $request->nostro_1_acc_name,
                    ]
                );

                //nostro2
                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'nostro_2_bank',
                    ], [
                        'type' => 'email', 'label' => 'nostro_2_bank', 'description' => $request->nostro_2_bank,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'nostro_2_branch',
                    ], [
                        'type' => 'email', 'label' => 'nostro_2_branch', 'description' => $request->nostro_2_branch,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'nostro_2_acc_number',
                    ], [
                        'type' => 'email', 'label' => 'nostro_2_acc_number', 'description' => $request->nostro_2_acc_number,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'nostro_2_acc_name',
                    ], [
                        'type' => 'email', 'label' => 'nostro_2_acc_name', 'description' => $request->nostro_2_acc_name,
                    ]
                );

            });
        } catch (\Exception$e) {
            return redirect()->back()->with(['error' => 'Something went wrong!!']);
        }
        return redirect()->back()->with(['success' => 'Settings saved successfullly!!']);

    }

    public function sendTestMail()
    {
        try {
            Mail::raw('Chiminya testing email', function ($m) {
                $m->to(config('mail.mailers.smtp.from.address'))->subject('Testing mails');
            });
        } catch (\Exception$e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        return redirect()->back()->with(['success' => 'email settings configured correctly']);
    }

    public function testImap()
    {
        try {
            $IMAPhost = \config('mail.imap.ImapHost');
            // IMAP port 143, 995 or POP3 port 110, 995
            $IMAPport = \config('mail.imap.ImapPort');
            $IMAPssl = \config('mail.imap.ImapEncryption');
            $IMAP = '{' . $IMAPhost . ':' . $IMAPport . '/imap/' . $IMAPssl . '/novalidate-cert}';
            $IMAPuser = \config('mail.imap.ImapUser');
            $IMAPass = \config('mail.imap.ImapPass');
            // imap email and password
            imap_open($IMAP, $IMAPuser, $IMAPass);
            return redirect()->back()->with(['success' => 'imap settings configured correctly']);
        } catch (\Exception$e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function systemSettings()
    {
        $settings = Settings::where('type', 'system')->pluck('description', 'label');
        return view('modules.settings.general-settings')->with(['settings' => $settings]);
    }

    public function storeSystemSettings(Request $request)
    {

        if (!Gate::allows('update', 'setting')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $request->validate([
            'app_name' => 'required',
            'app_email' => 'required',
            'app_url' => 'required',
        ]);

        try {
            DB::transaction(function () use ($request) {

                Settings::updateOrCreate(
                    [
                        'type' => 'system', 'label' => 'app_moto',
                    ], [
                        'type' => 'system', 'label' => 'app_moto', 'description' => $request->app_moto,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'system', 'label' => 'app_name',
                    ], [
                        'type' => 'system', 'label' => 'app_name', 'description' => $request->app_name,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'system', 'label' => 'app_email',
                    ], [
                        'type' => 'system', 'label' => 'app_email', 'description' => $request->app_email,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'system', 'label' => 'app_url',
                    ], [
                        'type' => 'system', 'label' => 'app_url', 'description' => $request->app_url,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'system', 'label' => 'app_phone',
                    ], [
                        'type' => 'system', 'label' => 'app_phone', 'description' => $request->app_phone,
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'system', 'label' => 'app_address',
                    ], [
                        'type' => 'system', 'label' => 'app_address', 'description' => $request->app_address,
                    ]
                );

                if ($request->hasfile('icon')) {
                    $file = $request->file('icon');
                    $file_name = time() . $file->getClientOriginalName();
                    $file->move('assets/files/', str_replace(' ', '', $file_name));

                    Settings::updateOrCreate(
                        [
                            'type' => 'system', 'label' => 'icon',
                        ], [
                            'type' => 'system', 'label' => 'icon', 'description' => 'assets/files/' . str_replace(' ', '', $file_name),
                        ]
                    );
                }

                if ($request->hasfile('logo')) {
                    $file = $request->file('logo');
                    $file_name = time() . $file->getClientOriginalName();
                    $file->move('assets/files/', str_replace(' ', '', $file_name));

                    Settings::updateOrCreate(
                        [
                            'type' => 'system', 'label' => 'logo',
                        ], [
                            'type' => 'system', 'label' => 'logo', 'description' => 'assets/files/' . str_replace(' ', '', $file_name),
                        ]
                    );
                }

                if ($request->hasfile('letter_head')) {
                    $file = $request->file('letter_head');
                    $file_name = time() . $file->getClientOriginalName();
                    $file->move('assets/files/', str_replace(' ', '', $file_name));

                    Settings::updateOrCreate(
                        [
                            'type' => 'system', 'label' => 'letter_head',
                        ], [
                            'type' => 'system', 'label' => 'letter_head', 'description' => 'assets/files/' . str_replace(' ', '', $file_name),
                        ]
                    );
                }

            });
        } catch (\Exception$e) {
            return redirect()->back()->with(['error' => 'Something went wrong!!']);
        }
        return redirect()->back()->with(['success' => 'Settings saved successfullly']);

    }
}
