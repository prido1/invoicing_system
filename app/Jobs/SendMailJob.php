<?php

namespace App\Jobs;

use App\Http\Controllers\InvoiceController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $invoice;
    protected $cause;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($invoice, $cause)
    {
        $this->invoice = $invoice;
        $this->cause = $cause;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invoice_controller = new InvoiceController();
        $invoice_controller->sendFromCron($this->invoice, $this->cause);
    }
}
