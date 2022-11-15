<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->date('date');
            $table->time('in');
            $table->time('out')->nullable();
            $table->string('email');
            $table->string('password');
            $table->enum('status', ['IN', 'OUT']);
            $table->enum('presence', ['attend', 'permit']);
            $table->longText('information')->nullable();
            $table->longText('attandance_prove')->nullable();
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
        Schema::dropIfExists('attendances');
    }
};
