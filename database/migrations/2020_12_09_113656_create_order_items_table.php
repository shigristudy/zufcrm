<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');  
            $table->integer('woo_order_id')->nullable();  
            $table->integer('product_id');    
            $table->string('name')->nullable();  
            $table->string('donation_type')->nullable();  
            $table->integer('quantity')->default(1);  
            $table->string('total')->default(0); 
            $table->string('type');  
            $table->integer('is_sponsor')->default(0);    
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
        Schema::dropIfExists('order_items');
    }
}
