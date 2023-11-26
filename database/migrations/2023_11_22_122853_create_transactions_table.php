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
            $table->bigIncrements('id');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->char('region', 2);
            $table->ipAddress('ip');
            $table->longText('user_agent')->nullable();
            $table->string('client');
            $table->enum('payment_method', ['credit_card', 'debit_card', 'pix', 'ticket']);
            $table->enum('payment_status', ['authorized', 'paid', 'canceled', 'declined', 'refunded', 'pending']);
            $table->enum('device', ['mobile', 'tablet', 'desktop']);
            $table->double('lat', 10, 8)->nullable();
            $table->double('long', 11, 8)->nullable();
            $table->decimal('value', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
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
