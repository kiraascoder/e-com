<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        Schema::create('bidangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('ketua_id')->nullable();
            $table->timestamps();

            $table->foreign('ketua_id')->references('id')->on('users')->nullOnDelete();
        });

        Schema::create('tim_rutins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bidang_id');
            $table->string('nama_tim');
            $table->unsignedBigInteger('penanggung_jawab_id');
            $table->string('deskripsi');
            $table->string('jadwal_pelaksanaan');
            $table->timestamps();
            $table->foreign('bidang_id')->references('id')->on('bidangs')->cascadeOnDelete();
            $table->foreign('penanggung_jawab_id')->references('id')->on('users')->cascadeOnDelete();
        });


        Schema::create('tim_rutin_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tim_rutin_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('tim_rutin_id')->references('id')->on('tim_rutins')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('alamat');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('pelapor_id')->nullable();
            $table->foreign('pelapor_id')->references('id')->on('users')->nullOnDelete();
            $table->string('nama_pelapor');
            $table->string('kontak_pelapor')->nullable();
            $table->enum('status_verifikasi', ['pending', 'diterima', 'ditolak', 'selesai'])->default('pending');
            $table->timestamp('tanggal_laporan')->useCurrent();
            $table->unsignedBigInteger('bidang_id');
            $table->timestamps();

            $table->foreign('bidang_id')->references('id')->on('bidangs')->cascadeOnDelete();
        });




        Schema::create('tim_non_rutins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laporan_id');
            $table->string('nama_tim')->nullable();
            $table->unsignedBigInteger('penanggung_jawab_id');
            $table->timestamps();
            $table->foreign('laporan_id')->references('id')->on('laporans')->cascadeOnDelete();
            $table->foreign('penanggung_jawab_id')->references('id')->on('users')->cascadeOnDelete();
        });


        Schema::create('tim_non_rutin_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tim_non_rutin_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('tim_non_rutin_id')->references('id')->on('tim_non_rutins')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });


        Schema::create('laporan_rutins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tim_rutin_id');
            $table->unsignedBigInteger('penanggung_jawab_id');
            $table->date('tanggal');
            $table->text('deskripsi');
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->string('sumber_anggaran')->nullable();
            $table->text('catatan_anggaran')->nullable();
            $table->timestamps();

            $table->foreign('tim_rutin_id')->references('id')->on('tim_rutins')->cascadeOnDelete();
            $table->foreign('penanggung_jawab_id')->references('id')->on('users')->cascadeOnDelete();
        });


        Schema::create('laporan_non_rutins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tim_non_rutin_id');
            $table->unsignedBigInteger('laporan_id');
            $table->unsignedBigInteger('penanggung_jawab_id');
            $table->date('tanggal');
            $table->text('deskripsi');
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->string('sumber_anggaran')->nullable();
            $table->text('catatan_anggaran')->nullable();
            $table->timestamps();

            $table->foreign('tim_non_rutin_id')->references('id')->on('tim_non_rutins')->cascadeOnDelete();
            $table->foreign('laporan_id')->references('id')->on('laporans')->cascadeOnDelete();
            $table->foreign('penanggung_jawab_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_non_rutins');
        Schema::dropIfExists('laporan_rutins');
        Schema::dropIfExists('tim_non_rutin_user');
        Schema::dropIfExists('tim_non_rutins');
        Schema::dropIfExists('laporans');
        Schema::dropIfExists('tim_rutin_user');
        Schema::dropIfExists('tim_rutins');
        Schema::dropIfExists('users');
        Schema::dropIfExists('bidangs');
    }
};
