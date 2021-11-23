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
        if (!Gate::allows('list', 'setting')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $settings = Settings::where('type', 'smtp')->pluck('description', 'label');
        return view('modules.settings.smtp-settings')->with(['settings'=>$settings]);
    }

    public function SmtpStore(Request $request)
    {
        if (!Gate::allows('update', 'setting')){
            return response()->json(['message'=>'not authorized'], 403);
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
            DB::transaction(function () use ($request){
                Settings::updateOrCreate(
                    [
                        'type' => 'smtp', 'label' => 'smtp_host',
                    ], [
                        'type' => 'smtp', 'label' => 'smtp_host', 'description' => $request->smtp_host
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'smtp', 'label' => 'smtp_port',
                    ], [
                        'type' => 'smtp', 'label' => 'smtp_port', 'description' => $request->smtp_port
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'smtp', 'label' => 'smtp_security',
                    ], [
                        'type' => 'smtp', 'label' => 'smtp_security', 'description' => $request->smtp_security
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'smtp', 'label' => 'username',
                    ], [
                        'type' => 'smtp', 'label' => 'username', 'description' => $request->username
                    ]
                );

                if ($request->password != null){
                    Settings::updateOrCreate(
                        [
                            'type' => 'smtp', 'label' => 'password',
                        ], [
                            'type' => 'smtp', 'label' => 'password', 'description' => $request->password
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
        }catch (\Exception $e){
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
        return redirect()->back()->with(['success' => 'settings saved successfullly']);

    }

    public function emailSettings()
    {
        //dd(config('config.EMAIL'));
        if (!Gate::allows('list', 'setting')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $settings = Settings::where('type', 'email')->pluck('description', 'label');
        return view('modules.settings.email-settings')->with(['settings'=>$settings]);
    }

    public function storeEmailSettings(Request $request)
    {
        if (!Gate::allows('update', 'setting')){
            return response()->json(['message'=>'not authorized'], 403);
        }

        try {
            DB::transaction(function () use ($request){
                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'bank',
                    ], [
                        'type' => 'email', 'label' => 'bank', 'description' => $request->bank
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'branch',
                    ], [
                        'type' => 'email', 'label' => 'branch', 'description' => $request->branch
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'acc_number',
                    ], [
                        'type' => 'email', 'label' => 'acc_number', 'description' => $request->acc_number
                    ]
                );

                Settings::updateOrCreate(
                    [
                        'type' => 'email', 'label' => 'acc_name',
                    ], [
                        'type' => 'email', 'label' => 'acc_name', 'description' => $request->acc_name
                    ]
                );


                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'ecco_number',
                        ], [
                            'type' => 'email', 'label' => 'ecco_number', 'description' => $request->ecco_number
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'ecco_name',
                        ], [
                            'type' => 'email', 'label' => 'ecco_name', 'description' => $request->ecco_name
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'show_eco',
                        ], [
                            'type' => 'email', 'label' => 'show_eco', 'description' => $request->show_eco ? 1 : 0
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'show_bank',
                        ], [
                            'type' => 'email', 'label' => 'show_bank', 'description' => $request->show_bank ? 1 : 0
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'show_nostro_1',
                        ], [
                            'type' => 'email', 'label' => 'show_nostro_1', 'description' => $request->show_nostro_1 ? 1 : 0
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'show_nostro_2',
                        ], [
                            'type' => 'email', 'label' => 'show_nostro_2', 'description' => $request->show_nostro_2 ? 1 : 0
                        ]
                    );
                    //nostro1
                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'nostro_1_bank',
                        ], [
                            'type' => 'email', 'label' => 'nostro_1_bank', 'description' => $request->nostro_1_bank
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'nostro_1_branch',
                        ], [
                            'type' => 'email', 'label' => 'nostro_1_branch', 'description' => $request->nostro_1_branch
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'nostro_1_acc_number',
                        ], [
                            'type' => 'email', 'label' => 'nostro_1_acc_number', 'description' => $request->nostro_1_acc_number
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'nostro_1_acc_name',
                        ], [
                            'type' => 'email', 'label' => 'nostro_1_acc_name', 'description' => $request->nostro_1_acc_name
                        ]
                    );

                     //nostro2
                     Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'nostro_2_bank',
                        ], [
                            'type' => 'email', 'label' => 'nostro_2_bank', 'description' => $request->nostro_2_bank
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'nostro_2_branch',
                        ], [
                            'type' => 'email', 'label' => 'nostro_2_branch', 'description' => $request->nostro_2_branch
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'nostro_2_acc_number',
                        ], [
                            'type' => 'email', 'label' => 'nostro_2_acc_number', 'description' => $request->nostro_2_acc_number
                        ]
                    );

                    Settings::updateOrCreate(
                        [
                            'type' => 'email', 'label' => 'nostro_2_acc_name',
                        ], [
                            'type' => 'email', 'label' => 'nostro_2_acc_name', 'description' => $request->nostro_2_acc_name
                        ]
                    );

            });
        }catch (\Exception $e){
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
        return redirect()->back()->with(['success' => 'settings saved successfullly']);

    }

    public function sendTestMail(){
        try {
            Mail::raw('Chiminya testing email', function ($m){
                $m->to(config('mail.mailers.smtp.from.address'))->subject('Testing mails');
            });
        }catch (\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        return redirect()->back()->with(['success' => 'email settings configured correctly']);
    }
}
