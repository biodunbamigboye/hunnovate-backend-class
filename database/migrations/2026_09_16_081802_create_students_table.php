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



        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('initials', 2);
            $table->enum('gender', ['male', 'female']);
            $table->string('course', 100);
            $table->integer('duration_in_months');
            $table->string('avatar', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
