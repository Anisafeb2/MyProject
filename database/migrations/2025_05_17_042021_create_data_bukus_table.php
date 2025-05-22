<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migrasi: membuat tabel data_bukus.
     */
    public function up(): void
    {
        Schema::create('data_bukus', function (Blueprint $table) {
            $table->id(); // ID otomatis
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->year('tahun_terbit');
            $table->integer('stok');
            $table->string('foto')->nullable(); // ✅ Kolom untuk menyimpan nama file foto
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Membatalkan migrasi: menghapus tabel data_bukus.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_bukus');
    }
};
