<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
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
            $table->foreignId('menu_id');
            $table->foreignId('user_id');
            $table->foreignId('table_id');
            $table->string('payment_method');
            $table->string('order_code');
            $table->string('quantity', 50);
            // $table->enum("service", ["takeAway", "delivery"]);
            $table->longText('detail');
            $table->string('price', 50);
            $table->string('total_pay', 50);
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
};
