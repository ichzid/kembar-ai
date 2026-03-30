<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * USERS
         */
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->string('avatar')->nullable();
        //     $table->string('google_id')->nullable();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->timestamps();
        // });

        /**
         * PERSONAS
         */
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('persona_name');
            $table->text('persona_description')->nullable();
            $table->text('role_summary')->nullable();
            $table->string('default_language')->default('id');
            $table->timestamps();
        });

        /**
         * PERSONA KNOWLEDGE (SINGLE TABLE INGESTION)
         */
        Schema::create('persona_knowledge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained()->cascadeOnDelete();
            $table->enum('type', [
                'bio',
                'experience',
                'opinion',
                'faq',
                'story',
                'content'
            ]);
            $table->longText('content');
            $table->string('source')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        /**
         * PERSONA SETTINGS
         */
        Schema::create('persona_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained()->cascadeOnDelete();
            $table->json('tone_style')->nullable();
            $table->enum('verbosity', ['short', 'normal', 'long'])->default('normal');
            $table->json('audience_default')->nullable();
            $table->json('guardrails')->nullable();
            $table->timestamps();
        });

        /**
         * WHATSAPP ACCOUNTS
         */
        Schema::create('whatsapp_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('persona_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unique('persona_id');
            $table->string('provider');
            $table->string('phone_number')->nullable()->unique();
            $table->enum('status', ['connected', 'disconnected', 'pending'])->default('pending');
            $table->text('qr_code')->nullable();
            $table->longText('session_data')->nullable();
            $table->timestamp('last_connected_at')->nullable();
            $table->timestamps();
        });

        /**
         * LEADS (PROGRESSIVE LEAD CAPTURE)
         */
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('interest')->nullable();
            $table->string('purpose')->nullable();
            $table->string('audience_type')->nullable();
            $table->json('details')->nullable();
            $table->enum('source', ['whatsapp', 'instagram'])->default('whatsapp');
            $table->string('conversation_stage')->nullable();
            $table->timestamp('last_interaction_at')->nullable();
            $table->timestamps();
        });

        /**
         * CHAT LOGS
         */
        Schema::create('chat_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lead_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('from_type', ['user', 'bot']);
            $table->text('message');
            $table->json('context_snapshot')->nullable();
            $table->timestamps();
        });

        /**
         * DECISION INBOX
         * AI Deal Screener & Qualification
         */
        Schema::create('decision_inboxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lead_id')->constrained()->cascadeOnDelete();
            $table->string('detected_intent')->nullable(); // kerjasama, brand, endorse, urgent
            $table->string('brand_name')->nullable();
            $table->string('cooperation_type')->nullable();
            $table->text('summary');
            $table->enum('estimated_value', ['low', 'medium', 'high', 'unknown'])->default('unknown');
            $table->enum('status', ['needs_review', 'interested', 'ignore', 'review_later', 'handed_off'])->default('needs_review');
            $table->timestamp('action_taken_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('decision_inboxes');
        Schema::dropIfExists('chat_logs');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('whatsapp_accounts');
        Schema::dropIfExists('persona_settings');
        Schema::dropIfExists('persona_knowledge');
        Schema::dropIfExists('personas');
        Schema::dropIfExists('users');
    }
};
