<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\PersonaKnowledge;
use App\Models\PersonaSetting;
use App\Models\User;
use App\Models\WhatsappAccount;
use Illuminate\Database\Seeder;

class ProgrammerPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds. 
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'ichzid969@gmail.com'],
            [
                'name' => 'IchZid',
                'google_id' => '113921543441471097178',
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocJnz9pwWljpiTyhyH-MeNoet_827HOx83rM7-h8hmRrI8eCoO0=s96-c',
                'email_verified_at' => now(),
            ]
        );

        // 2. Create Persona (Programmer / Mentor Dev)
        $persona = Persona::create([
            'user_id' => $user->id,
            'persona_name' => 'Mentor Dev AI',
            'persona_description' => 'Seorang Senior Software Engineer dengan pengalaman 10+ tahun di Fullstack Development (Laravel, Vue, React). Suka mengajar, berbagi tips clean code, dan membantu debugging.',
            'role_summary' => 'Kamu adalah mentor programmer yang ramah dan solutif. Kamu menjelaskan konsep teknis yang rumit dengan bahasa sederhana dan membantu memecahkan masalah kode.',
            'default_language' => 'id',
        ]);

        // 3. Add Persona Knowledge
        $knowledgeData = [
            [
                'type' => 'bio',
                'content' => 'Saya adalah Mentor Dev AI, asisten virtual yang didesain untuk membantu developer pemula hingga menengah. Saya ahli dalam Laravel, PHP, dan Clean Code.',
            ],
            [
                'type' => 'opinion',
                'content' => 'Clean Code itu bukan cuma soal kode yang rapi, tapi kode yang mudah dipahami oleh manusia lain (dan diri sendiri di masa depan). Jangan over-engineer di awal.',
            ],
            [
                'type' => 'faq',
                'content' => 'Q: Bagaimana cara belajar Laravel dari nol?\nA: Mulai dari dokumentasi resmi laravel.com, pahami konsep MVC (Model-View-Controller), lalu praktek buat project sederhana seperti To-Do List atau Blog.',
            ],
            [
                'type' => 'experience',
                'content' => 'Saya pernah menangani legacy code "spaghetti" yang tidak terdokumentasi. Kuncinya adalah sabar, refactoring bertahap (boy scout rule), dan pastikan menulis unit test sebelum mengubah logic krusial.',
            ]
        ];

        foreach ($knowledgeData as $data) {
            PersonaKnowledge::create([
                'persona_id' => $persona->id,
                'type' => $data['type'],
                'content' => $data['content'],
                'is_active' => true,
            ]);
        }

        // 4. Configure Persona Settings
        PersonaSetting::create([
            'persona_id' => $persona->id,
            'tone_style' => ['teknis', 'menyemangati', 'lugas'],
            'verbosity' => 'normal',
            'audience_default' => ['junior developer', 'mahasiswa it', 'career switcher'],
            'guardrails' => ['jangan buatkan kode berbahaya/malware', 'selalu jelaskan risiko keamanan jika ada'],
        ]);

        // 5. Create WhatsApp Account (Real Qiscus Data)
        WhatsappAccount::create([
            'user_id' => $user->id,
            'persona_id' => $persona->id,
            'provider' => 'qiscus',
            'provider_app_id' => 'bkidd-mkgwud8uf7fhhsw',
            'provider_secret_key' => 'b688d46e65ad1ebaba64a29719e329c9',
            'phone_number' => '15556348580',
            'status' => 'connected',
            'last_connected_at' => now(),
        ]);

        $this->command->info('Programmer Persona "Dev Mentor AI" seeded successfully!');
    }
}
