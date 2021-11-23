<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

        $due = Carbon::createFromDate('2021', '09', '13');
        $left = Carbon::now()->diffInDays($due);
        if($due <= Carbon::now()){
            //dd('Your hosting has been suspended please contact your hosting provider');
        }

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
        Route::post('/login', [\App\Http\Controllers\AuthController::class, 'signIn']);
    });
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

   

    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
        //invoice
        Route::group(['prefix' => 'invoice', 'as' => 'invoice.'], function () {
            Route::get('/', [\App\Http\Controllers\InvoiceController::class, 'index']);
            Route::get('search', [\App\Http\Controllers\InvoiceController::class, 'getBySearchTearm']);
            Route::get('view/{id}', [\App\Http\Controllers\InvoiceController::class, 'viewInvoice']);
            Route::get('create', [\App\Http\Controllers\InvoiceController::class, 'create']);
            Route::get('print/{id}', [\App\Http\Controllers\InvoiceController::class, 'printInvoice']);
            Route::get('copy/{id}', [\App\Http\Controllers\InvoiceController::class, 'copy']);
            Route::post('save', [\App\Http\Controllers\InvoiceController::class, 'saveInvoice']);
            Route::get('edit/{id}', [\App\Http\Controllers\InvoiceController::class, 'edit']);
            Route::post('update/{id}', [\App\Http\Controllers\InvoiceController::class, 'update']);
            Route::post('/send', [\App\Http\Controllers\InvoiceController::class, 'send']);
            Route::delete('destroy/{id}', [\App\Http\Controllers\InvoiceController::class, 'destroy']);
        });

        //quotation
        Route::group(['prefix' => 'quotation', 'as' => 'quotation.'], function () {
            Route::get('/', [\App\Http\Controllers\QuotationController::class, 'index']);
            Route::get('search', [\App\Http\Controllers\QuotationController::class, 'getBySearchTearm']);
            Route::get('view/{id}', [\App\Http\Controllers\QuotationController::class, 'viewQuotation']);
            Route::get('create', [\App\Http\Controllers\QuotationController::class, 'create']);
            Route::get('print/{id}', [\App\Http\Controllers\QuotationController::class, 'printQuotation']);
            Route::get('copy/{id}', [\App\Http\Controllers\QuotationController::class, 'copy']);
            Route::post('save', [\App\Http\Controllers\QuotationController::class, 'saveQuotation']);
            Route::get('edit/{id}', [\App\Http\Controllers\QuotationController::class, 'edit']);
            Route::post('update/{id}', [\App\Http\Controllers\QuotationController::class, 'update']);
            Route::post('send', [\App\Http\Controllers\QuotationController::class, 'send']);
            Route::delete('destroy/{id}', [\App\Http\Controllers\QuotationController::class, 'destroy']);
        });

        //user
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/', [\App\Http\Controllers\UserController::class, 'index']);
            Route::get('/create', [\App\Http\Controllers\UserController::class, 'create']);
            Route::get('/edit/{id}', [\App\Http\Controllers\UserController::class, 'edit']);
            Route::post('/update/{id}', [\App\Http\Controllers\UserController::class, 'update']);
            Route::post('/save', [\App\Http\Controllers\UserController::class, 'store']);
            Route::delete('/delete', [\App\Http\Controllers\UserController::class, 'destroy'])->name('delete');
            Route::post('/status', [\App\Http\Controllers\UserController::class, 'status'])->name('status');
        });

        //user
        Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
            Route::get('/', [\App\Http\Controllers\ClientController::class, 'index']);
            Route::get('/create', [\App\Http\Controllers\ClientController::class, 'createClient']);
            Route::get('/edit/{id}', [\App\Http\Controllers\ClientController::class, 'editClient']);
            Route::get('/search', [\App\Http\Controllers\ClientController::class, 'getBySearch']);
            Route::get('/client/{id}/delete', [\App\Http\Controllers\ClientController::class, 'destroy']);
            Route::post('save', [\App\Http\Controllers\ClientController::class, 'saveClient']);
            Route::post('update/{id}', [\App\Http\Controllers\ClientController::class, 'updateClient']);
        });

        //permission
        Route::resource('role', \App\Http\Controllers\RoleController::class);
        Route::resource('permission', \App\Http\Controllers\PermissionController::class);

        //settings
        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('/smtp', [\App\Http\Controllers\SettingsController::class, 'SmtpSettings']);
            Route::post('smtp/test',[\App\Http\Controllers\SettingsController::class,'sendTestMail']);
            Route::post('/smtp/store', [\App\Http\Controllers\SettingsController::class, 'SmtpStore']);
            Route::get('/email', [\App\Http\Controllers\SettingsController::class, 'emailSettings']);
            Route::post('/email', [\App\Http\Controllers\SettingsController::class, 'storeEmailSettings']);
        });

        //settings
        Route::group(['prefix' => 'expense', 'as' => 'expense.'], function () {
            Route::get('/', [\App\Http\Controllers\ExpenseController::class, 'index']);
            Route::get('/create', [\App\Http\Controllers\ExpenseController::class, 'create']);
            Route::get('/view/{id}', [\App\Http\Controllers\ExpenseController::class, 'viewExpense']);
            Route::post('/save', [\App\Http\Controllers\ExpenseController::class, 'save']);
        });

        //email template
        Route::group(['prefix' => 'etemplate', 'as' => 'etemplate.'], function () {
            Route::get('/', [\App\Http\Controllers\EmailTemplateController::class, 'index']);
            Route::get('/create', [\App\Http\Controllers\EmailTemplateController::class, 'create']);
            Route::post('/save', [\App\Http\Controllers\EmailTemplateController::class, 'save']);
            Route::get('/edit/{id}', [\App\Http\Controllers\EmailTemplateController::class, 'edit']);
            Route::post('/template', [\App\Http\Controllers\EmailTemplateController::class, 'getTemplateInvoice']);
            Route::post('/template/quotation', [\App\Http\Controllers\EmailTemplateController::class, 'getTemplateQuotation']);
            Route::post('/update/{id}', [\App\Http\Controllers\EmailTemplateController::class, 'update']);
        });

        Route::get('profile', [\App\Http\Controllers\UserProfile::class, 'index']);
        Route::post('profile/update', [\App\Http\Controllers\UserProfile::class, 'update']);


    });

    Route::get('test', function () {

    });

});

Route::get('migrate', function (){
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh');
    }catch (\Exception $e){
        return $e->getMessage();
    }
    return 'migration done';
});

Route::get('seed', function (){
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed');
    }catch (\Exception $e){
        return $e->getMessage();
    }
    return 'seeding done';
});
