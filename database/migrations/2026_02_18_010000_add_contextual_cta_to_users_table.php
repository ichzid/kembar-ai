<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('contextual_cta_enabled')->default(false)->after('leads_enabled');
            $table->text('contextual_cta_text')->nullable()->after('contextual_cta_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['contextual_cta_enabled', 'contextual_cta_text']);
        });
    }
};

