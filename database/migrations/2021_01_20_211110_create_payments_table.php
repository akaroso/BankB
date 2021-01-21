<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('DebitedAccountNumber');
            $table->string('DebitedNameAndAddress'); 
            $table->string('CreditedAccountNumber'); 
            $table->string('CreditedNameAndAddress'); 
            $table->string('Title');        
            $table->float('Amount');
            $table->bigInteger('payment_storage_id')->unsigned()->nullable();

     //       $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
