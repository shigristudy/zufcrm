<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGocardlessInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gocardless_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('gcl_customer_id');
            $table->string('gcl_customer_bank_id');
            $table->string('gcl_mandate_id');
            $table->string('gcl_subscription_id');
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
        Schema::dropIfExists('gocardless_infos');
    }
}
