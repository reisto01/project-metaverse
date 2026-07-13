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
        

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('picture')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->index();
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('is_deleted')->default(true);
            $table->index(['is_deleted', 'created_at']);


           

        });


        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
