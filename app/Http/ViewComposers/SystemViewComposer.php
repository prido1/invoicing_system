<?php

namespace App\Http\ViewComposers;

use App\Models\Settings;
use Illuminate\Contracts\View\View;

class SystemViewComposer{

    public function compose(View $view){
        $settings = Settings::where('type', 'system')->pluck('description', 'label');
        $view->with(['global_settings' => $settings]);
    }
}