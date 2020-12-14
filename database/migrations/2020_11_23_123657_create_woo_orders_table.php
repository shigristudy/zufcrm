<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWooOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('woo_orders', function (Blueprint $table) {
            
            $table->id();
            $table->integer('order_id');
            $table->string('donation_type')->default('online');
            $table->string('gift_aid')->nullable();
            $table->string('title')->nullable();
            $table->string('donation_date')->nullable();
            $table->string('number_of_items')->default(1);
            $table->string('is_sponsor_count')->default(0);
            $table->string('order_total')->default(0);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_method_title')->nullable();
            $table->text('order_meta')->nullable();
            $table->string('submitted')->nullable();
            $table->string('claimed')->nullable();
            $table->integer('report_id')->nullable();
            $table->timestamp('is_allocated')->nullable();
            
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
        Schema::dropIfExists('woo_orders');
    }
}
