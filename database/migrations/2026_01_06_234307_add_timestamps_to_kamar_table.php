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
        if (! Schema::hasTable('kamar') || Schema::hasColumn('kamar', 'created_at')) {
            return;
        }

        Schema::table('kamar', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        if (! Schema::hasTable('kamar') || ! Schema::hasColumn('kamar', 'created_at')) {
            return;
        }

        Schema::table('kamar', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
};
