<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->timestamps();

            // ✅ Make username unique per company
            $table->unique(['username', 'company_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
