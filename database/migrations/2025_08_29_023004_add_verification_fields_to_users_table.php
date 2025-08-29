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
        Schema::table('users', function (Blueprint $table) {
            // Add new profile fields
            $table->string('country', 2)->nullable()->after('email'); // ISO country code
            $table->string('currency_preferred', 3)->default('USD')->after('country'); // ISO currency code
            $table->string('google_id')->nullable()->after('provider_id'); // Specific Google ID
            $table->string('avatar_url')->nullable()->after('avatar'); // Avatar URL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'country',
                'currency_preferred', 
                'google_id',
                'avatar_url'
            ]);
        });
    }
};
