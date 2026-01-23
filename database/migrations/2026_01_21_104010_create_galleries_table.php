<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This migration is deprecated - use 2026_01_21_000000_create_galleries_table instead
     */
    public function up(): void
    {
        // Deprecated - galleries table already created in earlier migration
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No action needed
    }
};
