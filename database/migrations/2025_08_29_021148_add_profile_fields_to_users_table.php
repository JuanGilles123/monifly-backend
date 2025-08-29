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
            // Social authentication fields
            $table->string('provider')->nullable()->after('email'); // google, facebook, etc.
            $table->string('provider_id')->nullable()->after('provider');
            $table->string('avatar')->nullable()->after('provider_id'); // URL del avatar
            
            // Profile fields
            $table->string('phone')->nullable()->after('avatar');
            $table->date('birth_date')->nullable()->after('phone');
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable()->after('birth_date');
            
            // MoniFly specific fields
            $table->string('currency', 3)->default('USD')->after('gender'); // USD, EUR, MXN, etc.
            $table->string('timezone')->default('UTC')->after('currency');
            $table->string('language', 2)->default('en')->after('timezone'); // en, es, fr, etc.
            
            // Financial profile
            $table->decimal('monthly_income', 12, 2)->nullable()->after('language');
            $table->json('financial_goals')->nullable()->after('monthly_income'); // JSON array of goals
            
            // App preferences
            $table->boolean('notifications_enabled')->default(true)->after('financial_goals');
            $table->boolean('email_notifications')->default(true)->after('notifications_enabled');
            $table->boolean('push_notifications')->default(true)->after('email_notifications');
            
            // Account status
            $table->boolean('profile_completed')->default(false)->after('push_notifications');
            $table->timestamp('last_active_at')->nullable()->after('profile_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'provider',
                'provider_id', 
                'avatar',
                'phone',
                'birth_date',
                'gender',
                'currency',
                'timezone',
                'language',
                'monthly_income',
                'financial_goals',
                'notifications_enabled',
                'email_notifications',
                'push_notifications',
                'profile_completed',
                'last_active_at'
            ]);
        });
    }
};
