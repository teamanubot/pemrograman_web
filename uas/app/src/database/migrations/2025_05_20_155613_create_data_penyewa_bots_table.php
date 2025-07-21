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
        Schema::create('data_penyewa_bots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_id')->constrained('akuns')->onDelete('cascade');
            $table->string('nama');
            $table->enum('jenisbot', ['selfbot', 'official bot']);
            $table->dateTime('waktu_beli')->nullable();
            $table->dateTime('waktu_habis')->nullable();

            $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penyewa_bots');
    }
};