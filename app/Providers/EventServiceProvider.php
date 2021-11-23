<?php

namespace App\Providers;

use App\Events\BalanceTopup;
use App\Events\ChangePassword;
use App\Events\Fixture;
use App\Events\NewDeposit;
use App\Events\NewTransfer;
use App\Events\NewWithdrawal;
use App\Events\ResetPassword;
use App\Events\TicketUpdate;
use App\Events\UserUpdated;
use App\Listeners\BalanceTopupListener;
use App\Listeners\ChangePasswordListener;
use App\Listeners\NewDepositListener;
use App\Listeners\NewTransferListener;
use App\Listeners\NewWithdrawalListener;
use App\Listeners\NotifyAdminOfNewUserListener;
use App\Listeners\ResetPasswordListener;
use App\Listeners\SendWelcomeEmailListener;
use App\Listeners\TicketUpdateListener;
use App\Listeners\UpdateTicket;
use App\Listeners\UserUpdateListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
//            SendEmailVerificationNotification::class,
            SendWelcomeEmailListener::class, //done
            NotifyAdminOfNewUserListener::class
        ],
        BalanceTopup::class => [
            BalanceTopupListener::class //done
        ],
        ChangePassword::class => [
            ChangePasswordListener::class //done
        ],
        NewDeposit::class => [
            NewDepositListener::class //done
        ],
        NewTransfer::class => [
            NewTransferListener::class //done
        ],
        NewWithdrawal::class => [
            NewWithdrawalListener::class //done
        ],
        ResetPassword::class => [
            ResetPasswordListener::class //done
        ],
        TicketUpdate::class => [
            TicketUpdateListener::class //done
        ],
        UserUpdated::class => [
            UserUpdateListener::class //done
        ]
    ];
//    even:generate

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
