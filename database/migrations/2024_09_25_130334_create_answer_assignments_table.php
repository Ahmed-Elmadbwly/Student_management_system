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
        Schema::create('answer_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('answerFile');
            $table->string('title');
            $table->foreignId('userId')->constrained('users');
            $table->foreignId('assignmentId')->constrained('assignments');
            $table->bigInteger('score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_assignments');
    }
};
