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
        Schema::create('tb_metamap', function (Blueprint $table) {
            $table->id();
            $table->string('owner');
            $table->string('title')->unique();
            $table->longText('description');
            $table->string('url');
            $table->string('image');
            $table->decimal('price', 14, 2);
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
        Schema::dropIfExists('tb_metamap');
    }
};
