<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('admin')->after('status');
        });

        // Insert the admin user
        DB::table('users')->insert([
            'name' => 'Mohammad Naufal Murfid',
            'email' => 'mohammadnaufalmurfid@gmail.com',
            'jenis_kelamin' => 'Laki-laki',
            'umur' => 18,
            'status' => 'active',
            'role' => 'admin',
            'password' => Hash::make('naufal123#'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Aurellia Ledy Ulhaq',
            'email' => 'aurellialedyul0512@gmail.com',
            'jenis_kelamin' => 'Perempuan',
            'umur' => 19,
            'status' => 'active',
            'role' => 'admin',
            'password' => Hash::make('aurel0512'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
