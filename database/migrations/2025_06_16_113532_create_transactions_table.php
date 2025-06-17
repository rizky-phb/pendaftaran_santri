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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('pembayaran_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->decimal('amount', 12, 2);
            $table->string('status')->default('pending');
            $table->string('payment_type')->nullable();
            $table->string('transaction_time')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('bank')->nullable();           // dari va_numbers
            $table->string('va_number')->nullable();      // dari va_numbers
            $table->string('status_message')->nullable(); // pesan sukses atau error
            $table->string('pdf_url')->nullable();        // jika ada
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
