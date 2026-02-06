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
        Schema::table('projects', function (Blueprint $table) {
            $table->decimal('total_value', 10, 2)->nullable();
            $table->decimal('entry_value', 10, 2)->nullable();
            $table->string('payment_status')->default('pending'); // pending, partial, paid
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['total_value', 'entry_value', 'payment_status']);
        });
    }
};
