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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->uniqid();
            $table->foreignId('billing_id')->constrained();
            $table->string('transaction_id'); // Paystack transaction ID
            $table->string('reference')->unique();
            $table->decimal('amount', 15, 2); // Payment amount
            $table->string('reciept_number')->nullable();
            $table->string('paid_at')->nullable();
            $table->string('channel')->nullable();
            $table->string('currency')->default('GHS')->nullable();
            $table->enum('status',['success','failed','canceled','pending'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
