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
        Schema::create('submitted_data', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('_id')->nullable()->unique();
            $table->longText('rec')->nullable();
            $table->longText('send_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submitted_data');
    }
};
