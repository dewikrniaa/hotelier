<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (! Schema::hasTable('checkin') || Schema::hasColumn('checkin', 'created_at')) {
            return;
        }

        Schema::table('checkin', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        if (! Schema::hasTable('checkin') || ! Schema::hasColumn('checkin', 'created_at')) {
            return;
        }

        Schema::table('checkin', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
};
