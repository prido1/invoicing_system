<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_type');
            $table->unsignedBigInteger('payment_status');
            $table->unsignedBigInteger('payment_currency');
            $table->integer('discount');
            $table->date('create_date');
            $table->date('due_date');
            $table->longText('note');
            $table->longText('terms_condition');
            $table->longText('email_subject');
            $table->longText('email_body');
            $table->boolean('attach');
            $table->boolean('is_schedule_sent')->default(false);
            $table->boolean('is_scheduled');
            $table->dateTime('schedule_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
