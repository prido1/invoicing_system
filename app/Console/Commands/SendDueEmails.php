<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendDueEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $invoices = Invoice::where(function ($query){
            $query->where('is_scheduled', true)->where('is_schedule_sent', false)->whereDate('schedule_date', '<=', Carbon::now());
        })->get();

        foreach ($invoices as $invoice){
               dispatch(new SendMailJob($invoice, 'schedule'));
        }
    }
}
