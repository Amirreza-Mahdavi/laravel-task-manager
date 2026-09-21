<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    
    public function up(): void {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_task_id')->nullable()->constrained('tasks')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('status', 50);
            $table->string('priority', 50);
            $table->timestampTz('due_date')->nullable();
            $table->timestampsTz();
        });

        DB::statement("ALTER TABLE tasks
        ADD CONSTRAINT tasks_status_check
        CHECK (status IN ('Todo', 'DOING', 'DONE'))");

        DB::statement("ALTER TABLE tasks
        ADD CONSTRAINT tasks_priority_check
        CHECK (priority IN ('LOW', 'MEDIUM', 'HIGH'))");
    }
    
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
