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
        Schema::table('legacy_givings', function (Blueprint $table) {
            $table->decimal('recaptcha_score', 2, 1)
                ->nullable()
                ->comment('reCAPTCHA v3 score (0.0 - 0.9)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
