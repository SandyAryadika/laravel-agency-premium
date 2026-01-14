<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID Benar
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();

            // PERBAIKAN DISINI: Ganti default 'active' jadi 'pending'
            $table->string('status')->default('pending')->index();

            $table->date('start_date');
            $table->date('due_date')->nullable();
            $table->decimal('budget', 15, 2)->default(0);
            $table->json('meta_data')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
