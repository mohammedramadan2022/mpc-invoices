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
        Schema::table('clients', function (Blueprint $table) {
            $table->string('invoice_start')->after('is_password_set')->nullable(); // Add your column here
            $table->string('quote_start')->after('invoice_start')->nullable(); // Add your column here

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('invoice_start');
            $table->dropColumn('quote_start');

        });
    }
};
