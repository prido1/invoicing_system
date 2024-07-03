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
            $table->integer('discount')->nullable();
            $table->integer('vat')->nullable();
            $table->date('create_date')->nullable();
            $table->date('due_date')->nullable();
            $table->longText('note')->nullable();
            $table->longText('terms_condition')->nullable();
            $table->longText('email_subject')->nullable();
            $table->longText('email_body')->nullable();
            $table->boolean('attach')->nullable();
            $table->boolean('is_schedule_sent')->default(false);
            $table->boolean('is_scheduled')->nullable();
            $table->dateTime('schedule_date')->nullable();
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
