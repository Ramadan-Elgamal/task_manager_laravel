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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->date('due_date');
        $table->string('priority')->default('medium');
        $table->string('status')->default('to_do');

        $table->foreignId('creator_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('assignee_id')->constrained('users')->cascadeOnDelete();
        
        $table->timestamps(); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
