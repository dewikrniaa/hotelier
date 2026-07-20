<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('tipe_kamar')) {
            Schema::create('tipe_kamar', function (Blueprint $table) {
                $table->id();
                $table->string('nama_tipe', 50);
                $table->integer('harga');
                $table->integer('kapasitas');
            });
        }

        if (! Schema::hasTable('kamar')) {
            Schema::create('kamar', function (Blueprint $table) {
                $table->uuid('id_kamar')->primary();
                $table->string('no_kamar')->unique();
                $table->string('status');
                $table->unsignedBigInteger('tipe_kamar_id');
            });
        }

        if (! Schema::hasTable('pelanggan')) {
            Schema::create('pelanggan', function (Blueprint $table) {
                $table->uuid('id_pelanggan')->primary();
                $table->string('nama');
                $table->string('nik');
                $table->string('foto_ktp');
                $table->string('email');
                $table->text('alamat');
                $table->string('no_hp');
            });
        }

        if (! Schema::hasTable('checkin')) {
            Schema::create('checkin', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->date('checkin_date');
                $table->date('checkout_date');
                $table->uuid('id_pelanggan');
                $table->uuid('id_kamar');
                $table->integer('total_harga');
                $table->string('status_checkin');
                $table->enum('status_pembayaran', ['Belum Bayar', 'Lunas'])->default('Belum Bayar');
                $table->string('metode_pembayaran', 50)->nullable();
                $table->dateTime('tanggal_bayar')->nullable();
            });
        }

        if (! Schema::hasTable('audit_logs')) {
            Schema::create('audit_logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('action', 50);
                $table->string('table_name', 50);
                $table->uuid('record_id')->nullable();
                $table->text('description')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('checkin');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('kamar');
        Schema::dropIfExists('tipe_kamar');
    }
};
