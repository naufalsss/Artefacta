<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // Add the new category_id column
            $table->unsignedBigInteger('category_id')->nullable()->after('category');

            // Copy data from category string to category_id
            // Assuming categories exist, map by name
            $categories = \App\Models\Category::pluck('id', 'name');
            \App\Models\Menu::all()->each(function ($menu) use ($categories) {
                $categoryName = is_object($menu->category) ? $menu->category->name : $menu->category;
                if (isset($categories[$categoryName])) {
                    $menu->update(['category_id' => $categories[$categoryName]]);
                }
            });

            // Drop the old category column
            $table->dropColumn('category');

            // Add foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // Remove foreign key
            $table->dropForeign(['category_id']);

            // Add back the category string column
            $table->string('category')->nullable()->after('category_id');

            // Copy data back
            \App\Models\Menu::with('category')->get()->each(function ($menu) {
                $menu->update(['category' => $menu->category->name ?? null]);
            });

            // Drop category_id
            $table->dropColumn('category_id');
        });
    }
};
