<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE audit_logs MODIFY user_id BIGINT UNSIGNED NULL');

        Schema::table('audit_logs', function ($table) {
            $table->index('user_id', 'audit_logs_user_id_index');

            $table->foreign('user_id', 'audit_logs_user_id_foreign')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('audit_logs', function ($table) {
            $table->dropForeign('audit_logs_user_id_foreign');
            $table->dropIndex('audit_logs_user_id_index');
        });

        DB::statement('ALTER TABLE audit_logs MODIFY user_id CHAR(36) NULL');
    }
};
