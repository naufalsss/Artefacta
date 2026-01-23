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
        // Check if table exists before adding columns
        if (Schema::hasTable('galleries')) {
            Schema::table('galleries', function (Blueprint $table) {
                // Add crop positioning fields only if they don't exist
                if (!Schema::hasColumn('galleries', 'crop_x')) {
                    $table->integer('crop_x')->default(0)->after('image_path');
                }
                if (!Schema::hasColumn('galleries', 'crop_y')) {
                    $table->integer('crop_y')->default(0)->after(Schema::hasColumn('galleries', 'crop_x') ? 'crop_x' : 'image_path');
                }
                if (!Schema::hasColumn('galleries', 'crop_width')) {
                    $table->integer('crop_width')->nullable()->after(Schema::hasColumn('galleries', 'crop_y') ? 'crop_y' : 'image_path');
                }
                if (!Schema::hasColumn('galleries', 'crop_height')) {
                    $table->integer('crop_height')->nullable()->after(Schema::hasColumn('galleries', 'crop_width') ? 'crop_width' : 'image_path');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('galleries')) {
            Schema::table('galleries', function (Blueprint $table) {
                if (Schema::hasColumn('galleries', 'crop_x')) {
                    $table->dropColumn(['crop_x', 'crop_y', 'crop_width', 'crop_height']);
                }
            });
        }
    }
};
