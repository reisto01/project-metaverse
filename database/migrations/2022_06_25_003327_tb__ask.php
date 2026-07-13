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
        Schema::create('tb_mail', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->longText('message');
            $table->longText('answere')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('tb_mail');
    }
};
