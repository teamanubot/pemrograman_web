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

        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_id')->constrained('akuns')->onDelete('cascade');
            $table->string('nama');
            $table->string('whatsapp_number')->nullable();
            $table->enum('subscription_type', ['selfbot', 'official bot']);
            $table->enum('payment_status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->foreignId('payment_transaction_id')
                ->nullable()
                ->constrained('payment_transactions')
                ->onDelete('set null');

            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};