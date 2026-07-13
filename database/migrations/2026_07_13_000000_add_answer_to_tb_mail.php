<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasColumn('tb_mail', 'answere')) {
            Schema::table('tb_mail', function (Blueprint $table) {
                $table->longText('answere')->nullable()->after('message');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('tb_mail', 'answere')) {
            Schema::table('tb_mail', function (Blueprint $table) {
                $table->dropColumn('answere');
            });
        }
    }
};
