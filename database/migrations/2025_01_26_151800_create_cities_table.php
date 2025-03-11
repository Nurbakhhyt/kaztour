<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 1. Cities table
return new class extends Migration {
    public function up(): void {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->string('city_code')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('cities');
    }
};
