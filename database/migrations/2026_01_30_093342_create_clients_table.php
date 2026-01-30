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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('company');
            $table->enum('source', ['advertising', 'call', 'site'])
                ->default('site')
                ->comment('Источник заявки: реклама, сайт, звонок');
            $table->unsignedBigInteger('manager_id');
            $table->foreign('manager_id')
                ->references('id')
                ->on('users');
            $table->enum('status', ['new', 'active', 'archived']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
