<?php

namespace Database\Seeders;

use App\Models\ChatLog;
use App\Models\DecisionInbox;
use App\Models\Lead;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Seeder ini akan membuat:
     * - 15 Leads dummy (terhubung ke Persona pertama)
     * - 2–6 Chat Logs per Lead (percakapan user & bot)
     * - Decision Inbox untuk ~30% Lead yang terdeteksi penting
     * - 4 skenario Decision Inbox khusus (brand deals nyata)
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil Persona pertama (dari ProgrammerPersonaSeeder)
        $persona = Persona::first();

        if (!$persona) {
            $this->command->error('Tidak ada Persona ditemukan. Jalankan ProgrammerPersonaSeeder terlebih dahulu.');
            return;
        }

        $this->command->info('Membuat data dummy Leads, Chat Logs, dan Decision Inboxes...');

        // ── 1. LEADS + CHAT LOGS + DECISION INBOX (RANDOM) ──────────────────
        $interests  = ['Belajar Laravel', 'Mentoring React', 'Konsultasi Code', 'Debugging Help', 'Review Portofolio'];
        $purposes   = ['belajar', 'kerjasama', 'freelance', 'tugas kampus'];
        $stages     = ['new', 'engaged', 'qualified', 'customer'];

        $messageUser = [
            'Halo Kak, saya mau tanya soal Laravel nih.',
            'Ada error pas jalanin composer install, kenapa ya?',
            'Bisa review portofolio saya?',
            'Gimana sih cara mulai karir jadi web developer?',
            'Apa bedanya Vue dan React?',
            'Saya mau nanya soal kerjasama konten ya kak.',
            'Halo! Boleh tanya tentang mentoring premium gak?',
        ];

        $messageBot = [
            'Halo! Tentu, saya siap membantu. Boleh jelaskan detail pertanyaannya?',
            'Error composer biasanya karena versi PHP tidak cocok atau ada ekstensi yang kurang. Bisa di-copy pesan errornya?',
            'Sangat bisa! Silakan kirimkan link GitHub atau portfolio Anda.',
            'Untuk mulai, pastikan dasar HTML, CSS, dan Javascript sudah kuat ya.',
            'Keduanya bagus! Vue sering dibilang lebih mudah dipelajari, sedangkan React ekosistemnya lebih besar.',
            'Terima kasih sudah menghubungi! Bisa saya tahu lebih detail tentang rencananya?',
            'Oke, saya akan sampaikan ke tim. Ada hal lain yang bisa dibantu?',
        ];

        for ($i = 0; $i < 15; $i++) {
            $lastInteraction = $faker->dateTimeBetween('-1 month', 'now');

            $lead = Lead::create([
                'persona_id'         => $persona->id,
                'name'               => $faker->name,
                'phone'              => '628' . $faker->numerify('#########'),
                'email'              => $faker->safeEmail,
                'address'            => $faker->address,
                'city'               => $faker->city,
                'interest'           => $faker->randomElement($interests),
                'purpose'            => $faker->randomElement($purposes),
                'audience_type'      => $faker->randomElement(['Mahasiswa', 'Junior Dev', 'Career Switcher']),
                'source'             => 'whatsapp',
                'conversation_stage' => $faker->randomElement($stages),
                'last_interaction_at'=> $lastInteraction,
            ]);

            // Chat Logs untuk tiap Lead
            $numChats = rand(3, 8);
            for ($j = 0; $j < $numChats; $j++) {
                $isUser = $j % 2 === 0;
                ChatLog::create([
                    'persona_id' => $persona->id,
                    'lead_id'    => $lead->id,
                    'from_type'  => $isUser ? 'user' : 'bot',
                    'message'    => $isUser
                        ? $faker->randomElement($messageUser)
                        : $faker->randomElement($messageBot),
                    'created_at' => $faker->dateTimeBetween($lastInteraction, 'now'),
                    'updated_at' => now(),
                ]);
            }

            // Decision Inbox untuk ~30% Lead
            if (rand(1, 10) <= 3) {
                $intent = $faker->randomElement(['kerjasama', 'urgent_debugging', 'mentoring_premium']);
                DecisionInbox::create([
                    'persona_id'      => $persona->id,
                    'lead_id'         => $lead->id,
                    'detected_intent' => $intent,
                    'brand_name'      => $intent === 'kerjasama' ? $faker->company : null,
                    'cooperation_type'=> $intent === 'kerjasama' ? $faker->randomElement(['Sponsorship / Endorse', 'Brand Awareness', 'Product Review']) : null,
                    'summary'         => 'AI mendeteksi bahwa Lead ini memiliki ketertarikan tinggi untuk ' . str_replace('_', ' ', $intent) . ' dan membutuhkan respons dari admin.',
                    'estimated_value' => $faker->randomElement(['low', 'medium', 'high']),
                    'status'          => $faker->randomElement(['needs_review', 'interested', 'ignore', 'review_later', 'handed_off']),
                    'created_at'      => $faker->dateTimeBetween('-1 week', 'now'),
                    'updated_at'      => now(),
                ]);
            }
        }

        // ── 2. SKENARIO DECISION INBOX KHUSUS (brand deals nyata) ───────────
        // Ambil 4 leads yang baru saja dibuat (terakhir dimasukkan)
        $recentLeads = Lead::where('persona_id', $persona->id)->latest()->take(4)->get();

        $brandDeals = [
            [
                'detected_intent'  => 'partnership',
                'brand_name'       => 'Kopi Kenangan',
                'cooperation_type' => 'Endorsement / Paid Promote',
                'summary'          => 'Agensi dari Kopi Kenangan menawarkan kerjasama endorsement untuk produk kopi susu varian baru. Mereka meminta ratecard dan jadwal kosong di bulan depan.',
                'estimated_value'  => 'medium',
                'status'           => 'needs_review',
                'action_taken_at'  => null,
                'created_at'       => Carbon::now()->subDays(2),
            ],
            [
                'detected_intent'  => 'collaboration',
                'brand_name'       => 'Erigo Store',
                'cooperation_type' => 'Brand Ambassador / Long-term',
                'summary'          => 'Brand fashion Erigo tertarik kerjasama jangka panjang sebagai brand ambassador selama 6 bulan. Rencana pemotretan di Jepang.',
                'estimated_value'  => 'high',
                'status'           => 'interested',
                'action_taken_at'  => Carbon::now()->subHours(5),
                'created_at'       => Carbon::now()->subDays(5),
            ],
            [
                'detected_intent'  => 'event_invitation',
                'brand_name'       => 'Jakarta X Beauty',
                'cooperation_type' => 'Guest Star / Speaker',
                'summary'          => 'Undangan untuk menjadi pembicara tamu di event Jakarta X Beauty hari ke-2. Membahas peran AI dalam dunia kecantikan.',
                'estimated_value'  => 'medium',
                'status'           => 'ignore',
                'action_taken_at'  => Carbon::now()->subDays(1),
                'created_at'       => Carbon::now()->subDays(3),
            ],
            [
                'detected_intent'  => 'partnership',
                'brand_name'       => 'Shopee Indonesia',
                'cooperation_type' => 'Affiliate Product Review',
                'summary'          => 'Penawaran mereview produk eksklusif dari seller Shopee terpilih dengan komisi affiliate sebesar 15%. Tidak ada deadline yang ditentukan.',
                'estimated_value'  => 'unknown',
                'status'           => 'needs_review',
                'action_taken_at'  => null,
                'created_at'       => Carbon::now()->subHours(12),
            ],
        ];

        foreach ($brandDeals as $index => $deal) {
            // Gunakan Lead yang ada, atau fallback ke lead pertama jika kurang dari 4
            $lead = $recentLeads->get($index) ?? $recentLeads->first();
            if (!$lead) continue;

            DecisionInbox::create(array_merge($deal, [
                'persona_id'  => $persona->id,
                'lead_id'     => $lead->id,
                'updated_at'  => $deal['action_taken_at'] ?? $deal['created_at'],
            ]));
        }

        $this->command->info('Dummy data untuk Leads, Chat Logs, dan Decision Inboxes berhasil dibuat!');
    }
}
