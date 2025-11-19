<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('nama')->nullable();
            $table->string('kontak')->nullable();
            $table->enum('kategori', ['pelayanan', 'infrastruktur', 'sistem', 'lainnya'])
                ->nullable();
            $table->string('judul');
            $table->text('isi_saran');
            $table->unsignedTinyInteger('kepuasan')->nullable(); // 1–5
            $table->boolean('follow_up')->default(false);
            $table->enum('status_tindak_lanjut', ['baru', 'diproses', 'selesai'])
                ->default('baru');
            $table->timestamp('ditindaklanjuti_pada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saran');
    }
};
