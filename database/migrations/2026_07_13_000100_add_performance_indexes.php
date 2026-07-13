<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLES = ['users', 'tb_metamap', 'tb_metaprop', 'tb_mail'];

    public function up()
    {
        foreach (self::TABLES as $table) {
            if (Schema::hasTable($table) && ! Schema::hasIndex($table, ['is_deleted', 'created_at'])) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->index(['is_deleted', 'created_at']);
                });
            }
        }
    }

    public function down()
    {
        foreach (self::TABLES as $table) {
            if (Schema::hasTable($table) && Schema::hasIndex($table, ['is_deleted', 'created_at'])) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->dropIndex(['is_deleted', 'created_at']);
                });
            }
        }
    }
};
