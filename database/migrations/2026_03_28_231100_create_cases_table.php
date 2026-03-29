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
        if (!Schema::hasTable('cases')) {
            Schema::create('cases', function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('lawyer_id')->nullable()->constrained('users')->onDelete('set null');
                $table->string('title');
                $table->longText('description');
                $table->enum('case_type', ['Criminal', 'Civil', 'Family']);
                $table->enum('status', ['Pending', 'Active', 'Closed', 'On Hold'])->default('Pending');
                $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');
                $table->string('location');
                $table->date('deadline');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
