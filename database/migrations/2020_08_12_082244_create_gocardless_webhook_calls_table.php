<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateGocardlessWebhookCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gocardless_webhook_calls', function (Blueprint $table) {
            $table->increments('id');

            $table->string('resource_type')->nullable();
            $table->string('action')->nullable();
            $table->text('payload')->nullable();
            $table->text('exception')->nullable();

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
        Schema::dropIfExists('gocardless_webhook_calls');
    }
}