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
        Schema::create('apikeys', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->uniqid();
            $table->foreignId('company_id')->constrained();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('key');
            $table->boolean('is_active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apikeys');
    }
};
