<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('companies', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('primary_color')->nullable();
        $table->string('accent_color')->nullable();
        $table->string('logo_path')->nullable();
        $table->string('location')->nullable();
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
