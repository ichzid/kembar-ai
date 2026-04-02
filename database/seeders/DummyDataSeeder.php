<?php

namespace Database\Seeders;

use App\Models\ChatLog;
use App\Models\DecisionInbox;
use App\Models\Lead;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Ambil Persona pertama
        $persona = Persona::first();
        
        if (!$persona) {
            $this->command->error('Tidak ada Persona ditemukan. Jalankan ProgrammerPersonaSeeder terlebih dahulu.');
            return;
        }

        $this->command->info('Membuat data dummy untuk menu Leads, Chat Logs, dan Decision Inboxes...');

        // 1. Buat 15 Leads Dummy
        $interests = ['Belajar Laravel', 'Mentoring React', 'Konsultasi Code', 'Debugging Help', 'Review Portofolio'];
        $purposes = ['belajar', 'kerjasama', 'freelance', 'tugas kampus'];
        $stages = ['new', 'engaged', 'qualified', 'customer'];

        for ($i = 0; $i < 15; $i++) {
            $lead = Lead::create([
                'persona_id' => $persona->id,
                'name' => $faker->name,
                'phone' => '628' . $faker->numerify('##O#######'),
                'email' => $faker->safeEmail,
                'address' => $faker->address,
                'city' => $faker->city,
                'interest' => $faker->randomElement($interests),
                'purpose' => $faker->randomElement($purposes),
                'audience_type' => $faker->randomElement(['Mahasiswa', 'Junior Dev', 'Career Switcher']),
                'source' => 'whatsapp',
                'conversation_stage' => $faker->randomElement($stages),
                'last_interaction_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);

            // 2. Buat beberapa Chat Log untuk tiap Lead
            $numChats = rand(2, 6);
            for ($j = 0; $j < $numChats; $j++) {
                $isUser = $j % 2 == 0;
                
                $messageUser = [
                    'Halo Kak, saya mau tanya soal Laravel nih.',
                    'Ada error pas jalanin composer install, kenapa ya?',
                    'Bisa review portofolio saya?',
                    'Gimana sih cara mulai karir jadi web developer?',
                    'Apa bedanya Vue dan React?'
                ];

                $messageBot = [
                    'Halo! Tentu, saya siap membantu. Boleh jelaskan detail pertanyaannya?',
                    'Error composer install biasanya karena versi PHP tidak cocok atau ada ekstensi yang kurang. Bisa di-copy pesan errornya?',
                    'Sangat bisa! Silakan kirimkan link GitHub atau portfolio Anda.',
                    'Untuk memulai, pastikan dasar HTML, CSS, dan Javascript sudah kuat ya.',
                    'Keduanya bagus! Vue sering dibilang lebih mudah dipelajari, sedangkan React ekosistemnya lebih besar.'
                ];

                ChatLog::create([
                    'persona_id' => $persona->id,
                    'lead_id' => $lead->id,
                    'from_type' => $isUser ? 'user' : 'bot',
                    'message' => $isUser ? $faker->randomElement($messageUser) : $faker->randomElement($messageBot),
                    'created_at' => $faker->dateTimeBetween($lead->last_interaction_at, 'now'),
                ]);
            }

            // 3. Buat Decision Inbox untuk 30% Lead (seolah AI menyaring leads penting)
            if (rand(1, 10) <= 3) {
                $intent = $faker->randomElement(['kerjasama', 'urgent_debugging', 'mentoring_premium']);
                DecisionInbox::create([
                    'persona_id' => $persona->id,
                    'lead_id' => $lead->id,
                    'detected_intent' => $intent,
                    'brand_name' => $intent === 'kerjasama' ? $faker->company : null,
                    'cooperation_type' => $intent === 'kerjasama' ? 'Sponsorship / Endorse' : null,
                    'summary' => 'AI mendeteksi bahwa Lead ini memiliki ketertarikan tinggi untuk ' . str_replace('_', ' ', $intent) . ' dan membutuhkan respons dari admin.',
                    'estimated_value' => $faker->randomElement(['low', 'medium', 'high']),
                    'status' => $faker->randomElement(['needs_review', 'interested', 'ignore', 'review_later', 'handed_off']),
                    'created_at' => $faker->dateTimeBetween('-1 week', 'now'),
                ]);
            }
        }

        $this->command->info('Dummy data untuk Leads, Chat Logs, dan Decision Inboxes berhasil dibuat!');
    }
}
