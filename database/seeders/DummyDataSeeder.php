<?php

namespace Database\Seeders;

use App\Models\ChatLog;
use App\Models\DecisionInbox;
use App\Models\Lead;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * NOTE: Tidak menggunakan Faker agar kompatibel dengan production (--no-dev).
     */
    public function run(): void
    {
        // Ambil Persona pertama (dari ProgrammerPersonaSeeder)
        $persona = Persona::first();

        if (!$persona) {
            $this->command->error('Tidak ada Persona ditemukan. Jalankan ProgrammerPersonaSeeder terlebih dahulu.');
            return;
        }

        $this->command->info('Membuat data dummy Leads, Chat Logs, dan Decision Inboxes...');

        // ── DATA STATIS (tanpa Faker) ──────────────────────────────────────

        $leads_data = [
            ['name' => 'Andi Pratama',    'phone' => '6281234567801', 'email' => 'andi@gmail.com',    'city' => 'Jakarta',   'interest' => 'Belajar Laravel',     'purpose' => 'belajar',   'audience_type' => 'Mahasiswa',       'stage' => 'new'],
            ['name' => 'Budi Santoso',    'phone' => '6281234567802', 'email' => 'budi@gmail.com',    'city' => 'Bandung',   'interest' => 'Mentoring React',     'purpose' => 'kerjasama', 'audience_type' => 'Junior Dev',      'stage' => 'engaged'],
            ['name' => 'Citra Dewi',      'phone' => '6281234567803', 'email' => 'citra@gmail.com',   'city' => 'Surabaya',  'interest' => 'Konsultasi Code',     'purpose' => 'freelance', 'audience_type' => 'Career Switcher', 'stage' => 'qualified'],
            ['name' => 'Dian Purnama',    'phone' => '6281234567804', 'email' => 'dian@gmail.com',    'city' => 'Yogyakarta','interest' => 'Debugging Help',      'purpose' => 'belajar',   'audience_type' => 'Mahasiswa',       'stage' => 'new'],
            ['name' => 'Eko Wahyudi',     'phone' => '6281234567805', 'email' => 'eko@gmail.com',     'city' => 'Semarang',  'interest' => 'Review Portofolio',   'purpose' => 'tugas kampus','audience_type' => 'Mahasiswa',      'stage' => 'customer'],
            ['name' => 'Fitri Handayani', 'phone' => '6281234567806', 'email' => 'fitri@gmail.com',   'city' => 'Medan',     'interest' => 'Belajar Laravel',     'purpose' => 'belajar',   'audience_type' => 'Junior Dev',      'stage' => 'engaged'],
            ['name' => 'Gilang Saputra',  'phone' => '6281234567807', 'email' => 'gilang@gmail.com',  'city' => 'Makassar',  'interest' => 'Mentoring React',     'purpose' => 'kerjasama', 'audience_type' => 'Career Switcher', 'stage' => 'new'],
            ['name' => 'Hana Rizki',      'phone' => '6281234567808', 'email' => 'hana@gmail.com',    'city' => 'Palembang', 'interest' => 'Konsultasi Code',     'purpose' => 'freelance', 'audience_type' => 'Mahasiswa',       'stage' => 'qualified'],
            ['name' => 'Irfan Maulana',   'phone' => '6281234567809', 'email' => 'irfan@gmail.com',   'city' => 'Bali',      'interest' => 'Debugging Help',      'purpose' => 'belajar',   'audience_type' => 'Junior Dev',      'stage' => 'engaged'],
            ['name' => 'Joko Susilo',     'phone' => '6281234567810', 'email' => 'joko@gmail.com',    'city' => 'Jakarta',   'interest' => 'Review Portofolio',   'purpose' => 'kerjasama', 'audience_type' => 'Career Switcher', 'stage' => 'customer'],
            ['name' => 'Kartika Sari',    'phone' => '6281234567811', 'email' => 'kartika@gmail.com', 'city' => 'Bandung',   'interest' => 'Belajar Laravel',     'purpose' => 'tugas kampus','audience_type' => 'Mahasiswa',      'stage' => 'new'],
            ['name' => 'Lutfi Hakim',     'phone' => '6281234567812', 'email' => 'lutfi@gmail.com',   'city' => 'Surabaya',  'interest' => 'Mentoring React',     'purpose' => 'freelance', 'audience_type' => 'Junior Dev',      'stage' => 'qualified'],
            ['name' => 'Maya Indah',      'phone' => '6281234567813', 'email' => 'maya@gmail.com',    'city' => 'Yogyakarta','interest' => 'Konsultasi Code',     'purpose' => 'belajar',   'audience_type' => 'Career Switcher', 'stage' => 'engaged'],
            ['name' => 'Nanda Pratiwi',   'phone' => '6281234567814', 'email' => 'nanda@gmail.com',   'city' => 'Semarang',  'interest' => 'Debugging Help',      'purpose' => 'kerjasama', 'audience_type' => 'Mahasiswa',       'stage' => 'new'],
            ['name' => 'Oki Firmansyah',  'phone' => '6281234567815', 'email' => 'oki@gmail.com',     'city' => 'Medan',     'interest' => 'Review Portofolio',   'purpose' => 'belajar',   'audience_type' => 'Junior Dev',      'stage' => 'customer'],
        ];

        $messageUser = [
            'Halo Kak, saya mau tanya soal Laravel nih.',
            'Ada error pas jalanin composer install, kenapa ya?',
            'Bisa review portofolio saya?',
            'Gimana sih cara mulai karir jadi web developer?',
            'Apa bedanya Vue dan React?',
            'Saya mau nanya soal kerjasama konten ya kak.',
            'Halo! Boleh tanya tentang mentoring premium gak?',
            'Makasih kak! Sangat membantu sekali.',
        ];

        $messageBot = [
            'Halo! Tentu, saya siap membantu. Boleh jelaskan detail pertanyaannya?',
            'Error composer biasanya karena versi PHP tidak cocok. Bisa di-copy pesan errornya?',
            'Sangat bisa! Silakan kirimkan link GitHub atau portfolio Anda.',
            'Untuk mulai, pastikan dasar HTML, CSS, dan Javascript sudah kuat dulu ya.',
            'Keduanya bagus! Vue sering dibilang lebih mudah dipelajari, React ekosistemnya lebih besar.',
            'Terima kasih sudah menghubungi! Bisa saya tahu lebih detail tentang rencananya?',
            'Oke, saya akan sampaikan ke tim. Ada hal lain yang bisa dibantu?',
            'Sama-sama! Jangan ragu untuk bertanya lagi jika ada kendala.',
        ];

        $chatPatterns = [
            [0, 1, 2, 3],      // 4 messages
            [0, 1, 2, 3, 4, 5], // 6 messages
            [0, 1, 0, 1, 2, 3, 6, 7], // 8 messages
        ];

        $createdLeads = [];

        foreach ($leads_data as $index => $data) {
            $hoursAgo = ($index + 1) * 12; // spread dari 12 jam lalu hingga 7.5 hari lalu

            $lead = Lead::create([
                'persona_id'          => $persona->id,
                'name'                => $data['name'],
                'phone'               => $data['phone'],
                'email'               => $data['email'],
                'city'                => $data['city'],
                'interest'            => $data['interest'],
                'purpose'             => $data['purpose'],
                'audience_type'       => $data['audience_type'],
                'source'              => 'whatsapp',
                'conversation_stage'  => $data['stage'],
                'last_interaction_at' => Carbon::now()->subHours($hoursAgo),
            ]);

            // Chat logs dengan pola bergantian user/bot
            $pattern = $chatPatterns[$index % count($chatPatterns)];
            foreach ($pattern as $msgIndex) {
                $isUser = $msgIndex % 2 === 0;
                ChatLog::create([
                    'persona_id' => $persona->id,
                    'lead_id'    => $lead->id,
                    'from_type'  => $isUser ? 'user' : 'bot',
                    'message'    => $isUser ? $messageUser[$msgIndex % count($messageUser)] : $messageBot[$msgIndex % count($messageBot)],
                    'created_at' => Carbon::now()->subHours($hoursAgo - ($msgIndex * 0.5)),
                    'updated_at' => now(),
                ]);
            }

            $createdLeads[] = $lead;
        }

        // ── DECISION INBOX: Random dari leads ────────────────────────────────
        $randomDecisions = [
            ['lead_idx' => 1,  'intent' => 'kerjasama',         'brand' => 'Dicoding Academy',   'type' => 'Content Partnership',   'summary' => 'Dicoding mengajak kerjasama pembuatan konten video tutorial Laravel untuk platform belajar mereka.',         'value' => 'medium', 'status' => 'needs_review'],
            ['lead_idx' => 3,  'intent' => 'urgent_debugging',  'brand' => null,                 'type' => null,                    'summary' => 'Lead memiliki bug kritis di sistem payment e-commerce mereka dan membutuhkan bantuan segera dari senior dev.', 'value' => 'high',   'status' => 'interested'],
            ['lead_idx' => 6,  'intent' => 'mentoring_premium', 'brand' => null,                 'type' => null,                    'summary' => 'Calon client tertarik dengan program mentoring intensif 1-on-1 selama 3 bulan untuk persiapan kerja.',         'value' => 'high',   'status' => 'review_later'],
            ['lead_idx' => 9,  'intent' => 'kerjasama',         'brand' => 'BuildWithAngga',     'type' => 'Affiliate / Promo Code','summary' => 'Platform kursus BuildWithAngga menawarkan program afiliasi dengan komisi 20% per member yang menggunakan kode referral.', 'value' => 'low', 'status' => 'handed_off'],
            ['lead_idx' => 12, 'intent' => 'kerjasama',         'brand' => 'Hostinger Indonesia','type' => 'Sponsored Content',     'summary' => 'Hostinger meminta review dan tutorial cara deploy Laravel ke VPS mereka dengan imbal jasa konten berbayar.',  'value' => 'medium', 'status' => 'needs_review'],
        ];

        foreach ($randomDecisions as $d) {
            $lead = $createdLeads[$d['lead_idx']] ?? $createdLeads[0];
            DecisionInbox::create([
                'persona_id'       => $persona->id,
                'lead_id'          => $lead->id,
                'detected_intent'  => $d['intent'],
                'brand_name'       => $d['brand'],
                'cooperation_type' => $d['type'],
                'summary'          => $d['summary'],
                'estimated_value'  => $d['value'],
                'status'           => $d['status'],
                'action_taken_at'  => in_array($d['status'], ['interested', 'handed_off']) ? Carbon::now()->subHours(3) : null,
                'created_at'       => Carbon::now()->subDays(rand(1, 7)),
                'updated_at'       => now(),
            ]);
        }

        // ── DECISION INBOX: Skenario brand deals khusus ──────────────────────
        $brandDeals = [
            [
                'lead_idx'         => 0,
                'detected_intent'  => 'partnership',
                'brand_name'       => 'Kopi Kenangan',
                'cooperation_type' => 'Endorsement / Paid Promote',
                'summary'          => 'Agensi dari Kopi Kenangan menawarkan kerjasama endorsement untuk produk kopi susu varian baru. Mereka meminta ratecard dan jadwal kosong di bulan depan.',
                'estimated_value'  => 'medium',
                'status'           => 'needs_review',
                'action_taken_at'  => null,
                'days_ago'         => 2,
            ],
            [
                'lead_idx'         => 2,
                'detected_intent'  => 'collaboration',
                'brand_name'       => 'Erigo Store',
                'cooperation_type' => 'Brand Ambassador / Long-term',
                'summary'          => 'Brand fashion Erigo tertarik kerjasama jangka panjang sebagai brand ambassador selama 6 bulan. Rencana pemotretan di Jepang.',
                'estimated_value'  => 'high',
                'status'           => 'interested',
                'action_taken_at'  => Carbon::now()->subHours(5),
                'days_ago'         => 5,
            ],
            [
                'lead_idx'         => 4,
                'detected_intent'  => 'event_invitation',
                'brand_name'       => 'Jakarta X Beauty',
                'cooperation_type' => 'Guest Star / Speaker',
                'summary'          => 'Undangan untuk menjadi pembicara tamu di event Jakarta X Beauty hari ke-2. Membahas peran AI dalam dunia kecantikan.',
                'estimated_value'  => 'medium',
                'status'           => 'ignore',
                'action_taken_at'  => Carbon::now()->subDays(1),
                'days_ago'         => 3,
            ],
            [
                'lead_idx'         => 7,
                'detected_intent'  => 'partnership',
                'brand_name'       => 'Shopee Indonesia',
                'cooperation_type' => 'Affiliate Product Review',
                'summary'          => 'Penawaran mereview produk eksklusif dari seller Shopee terpilih dengan komisi affiliate sebesar 15%. Tidak ada deadline yang ditentukan.',
                'estimated_value'  => 'unknown',
                'status'           => 'needs_review',
                'action_taken_at'  => null,
                'days_ago'         => 0,
            ],
        ];

        foreach ($brandDeals as $deal) {
            $lead = $createdLeads[$deal['lead_idx']] ?? $createdLeads[0];
            DecisionInbox::create([
                'persona_id'       => $persona->id,
                'lead_id'          => $lead->id,
                'detected_intent'  => $deal['detected_intent'],
                'brand_name'       => $deal['brand_name'],
                'cooperation_type' => $deal['cooperation_type'],
                'summary'          => $deal['summary'],
                'estimated_value'  => $deal['estimated_value'],
                'status'           => $deal['status'],
                'action_taken_at'  => $deal['action_taken_at'],
                'created_at'       => Carbon::now()->subDays($deal['days_ago']),
                'updated_at'       => $deal['action_taken_at'] ?? Carbon::now()->subDays($deal['days_ago']),
            ]);
        }

        $this->command->info('Dummy data untuk Leads, Chat Logs, dan Decision Inboxes berhasil dibuat!');
    }
}
