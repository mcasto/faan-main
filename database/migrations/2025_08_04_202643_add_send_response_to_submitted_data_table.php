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
        Schema::table('submitted_data', function (Blueprint $table) {
            $table->json('send_response')->nullable()->after('rec');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submitted_data', function (Blueprint $table) {
            $table->dropColumn('send_response');
        });
    }
};
