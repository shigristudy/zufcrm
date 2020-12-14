<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type');
            $table->date('date_of_donation')->nullable();
            $table->string('full_name')->nullable();
            $table->string('gift_aid')->nullable();
            $table->string('giftaid_claimed')->default(0);
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('contact')->nullable();
            $table->string('email');
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
