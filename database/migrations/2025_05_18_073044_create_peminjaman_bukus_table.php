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
        Schema::create('peminjaman_bukus', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel data_anggotas dan data_bukus
            $table->unsignedBigInteger('anggota_id');
            $table->unsignedBigInteger('buku_id');

            // Tanggal peminjaman dan pengembalian
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');

            // Status peminjaman
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');

            // Timestamp
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('anggota_id')->references('id')->on('data_anggotas')->onDelete('cascade');
            $table->foreign('buku_id')->references('id')->on('data_bukus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_bukus');
    }
};
