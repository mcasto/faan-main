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
        Schema::create('legacy_givings', function (Blueprint $table) {
            $table->id();
            $table->string('legal_name_of_donor');
            $table->string('phone');
            $table->string('cedula_passport');
            $table->string('email');
            $table->string('address');
            $table->text('special_instructions')->nullable();
            $table->boolean('recognized')->default(false);
            $table->string('donation_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legacy_givings');
    }
};
