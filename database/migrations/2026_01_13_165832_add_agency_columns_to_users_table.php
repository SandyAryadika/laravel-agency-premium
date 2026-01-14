<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kita gabungkan semua kolom yang dibutuhkan disini
            // Gunakan after('...') agar rapi posisinya setelah kolom password/remember_token

            // Cek dulu agar tidak error jika kolom sudah ada (Safety Check)
            if (!Schema::hasColumn('users', 'agency_name')) {
                $table->string('agency_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'agency_email')) {
                $table->string('agency_email')->nullable();
            }
            if (!Schema::hasColumn('users', 'agency_phone')) {
                $table->string('agency_phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'agency_address')) {
                $table->text('agency_address')->nullable();
            }
            if (!Schema::hasColumn('users', 'agency_logo')) {
                $table->string('agency_logo')->nullable();
            }
            if (!Schema::hasColumn('users', 'tagline')) {
                $table->string('tagline')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'agency_name',
                'agency_email',
                'agency_phone',
                'agency_address',
                'agency_logo',
                'tagline'
            ]);
        });
    }
};
