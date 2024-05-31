<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('account_type')->default(3);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patient');
    }
};
