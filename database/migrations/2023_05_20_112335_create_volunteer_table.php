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
        Schema::create('volunteer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->string('qualification')->nullable();
            $table->string('img')->nullable();
            $table->string('phone')->nullable();
            $table->tinyInteger('status')->default(1)->comment("0=inActive,1=Active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer');
    }
};
