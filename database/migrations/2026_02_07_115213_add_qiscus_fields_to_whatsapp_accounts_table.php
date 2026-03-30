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
        Schema::table('whatsapp_accounts', function (Blueprint $table) {
            $table->string('provider_app_id')->nullable()->after('provider');
            $table->string('provider_secret_key')->nullable()->after('provider_app_id');
            
            $table->index('provider_app_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('whatsapp_accounts', function (Blueprint $table) {
            $table->dropIndex(['provider_app_id']);
            $table->dropColumn(['provider_app_id', 'provider_secret_key']);
        });
    }
};