<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('kamar', function (Blueprint $table) {
            $table->index('tipe_kamar_id', 'kamar_tipe_kamar_id_index');

            $table->foreign('tipe_kamar_id', 'kamar_tipe_kamar_id_foreign')
                ->references('id')
                ->on('tipe_kamar')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });

        Schema::table('checkin', function (Blueprint $table) {
            $table->index('id_pelanggan', 'checkin_id_pelanggan_index');
            $table->index('id_kamar', 'checkin_id_kamar_index');

            $table->foreign('id_pelanggan', 'checkin_id_pelanggan_foreign')
                ->references('id_pelanggan')
                ->on('pelanggan')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('id_kamar', 'checkin_id_kamar_foreign')
                ->references('id_kamar')
                ->on('kamar')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('checkin', function (Blueprint $table) {
            $table->dropForeign('checkin_id_pelanggan_foreign');
            $table->dropForeign('checkin_id_kamar_foreign');
            $table->dropIndex('checkin_id_pelanggan_index');
            $table->dropIndex('checkin_id_kamar_index');
        });

        Schema::table('kamar', function (Blueprint $table) {
            $table->dropForeign('kamar_tipe_kamar_id_foreign');
            $table->dropIndex('kamar_tipe_kamar_id_index');
        });
    }
};
