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
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->string('ticket')->unique();
            $table->text('description');
            $table->enum('status', ['open', 'resolved', 'elevated', 'closed'])->default('open');
            $table->foreignId('assigned_to')->constrained('users')->nullable()->onDelete('set null');;
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');;
            $table->text('solution')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problems');
    }
};
