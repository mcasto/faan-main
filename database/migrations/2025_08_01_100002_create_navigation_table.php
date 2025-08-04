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
        Schema::create('navigation', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_order')->default(0);
            $table->string('name_en')->nullable();
            $table->string('name_es')->nullable();
            $table->string('path')->nullable();
            $table->string('component_name')->nullable();
            $table->string('source')->nullable();
            $table->boolean('visible')->default(true);
            $table->integer('parent_id')->default(0);
            $table->boolean('external')->default(false);
            $table->boolean('external_blank')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation');
    }
};
