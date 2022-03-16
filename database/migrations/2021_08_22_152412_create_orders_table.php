<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("full_name")->nullable();
            $table->text("address")->nullable();
            $table->string("email")->nullable();
            $table->string("phone_one")->nullable();
            $table->string("phone_two")->nullable();
            $table->string("closest_mark")->nullable();
            $table->string("payment_type")->nullable();
            $table->timestamp("dispatched_at")->nullable();
            $table->timestamp("completed")->nullable();
//            $table->foreignId("customer_id");
            $table->double("total");
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
        Schema::dropIfExists('orders');
    }
}
