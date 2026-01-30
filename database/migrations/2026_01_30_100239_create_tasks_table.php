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
            $table->unsignedBigInteger('assigned_to');
            $table->foreign('assigned_to')
                ->references('id')
                ->on('users');
            $table->enum('related_type', ['client', 'deal']);
            $table->unsignedBigInteger('related_id');
            $table->dateTime('due_date')
                ->comment('deadline');
            $table->enum('status', ['New', 'in Progress', 'Done', 'Overdue']);
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
