<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->char('from_currency', 3)->default('LAK');
            $table->char('to_currency', 3);
            $table->decimal('rate', 18, 8);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['from_currency', 'to_currency']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
