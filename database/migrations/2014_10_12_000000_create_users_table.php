<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Запуск миграции.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['user','guide','moderator','admin'])->default('user'); // По умолчанию роль "user"
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Откат миграции.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
