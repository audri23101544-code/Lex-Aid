<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('cases')) {
            if (!Schema::hasColumn('cases', 'updated_at')) {
                Schema::table('cases', function (Blueprint $table) {
                    $table->timestamp('updated_at')->nullable()->after('created_at');
                });
            }

            DB::statement("ALTER TABLE cases MODIFY COLUMN status ENUM('open','in_progress','pending','active','closed','On Hold') NOT NULL DEFAULT 'pending'");
            DB::statement("ALTER TABLE cases MODIFY COLUMN priority ENUM('low','medium','high') NOT NULL DEFAULT 'medium'");
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('cases')) {
            if (Schema::hasColumn('cases', 'updated_at')) {
                Schema::table('cases', function (Blueprint $table) {
                    $table->dropColumn('updated_at');
                });
            }

            DB::statement("ALTER TABLE cases MODIFY COLUMN status ENUM('open','in_progress','closed') NOT NULL DEFAULT 'open'");
            DB::statement("ALTER TABLE cases MODIFY COLUMN priority ENUM('low','medium','high') NOT NULL DEFAULT 'medium'");
        }
    }
};
