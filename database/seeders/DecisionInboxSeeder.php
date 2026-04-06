<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DecisionInbox;
use App\Models\Persona;
use App\Models\Lead;
use App\Models\User;
use Carbon\Carbon;

class DecisionInboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Temukan atau buat User pertama
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'leads_enabled' => true,
            ]);
        }

        // Temukan atau buat Persona
        $persona = Persona::first();
        if (!$persona) {
            $persona = Persona::create([
                'user_id' => $user->id,
                'persona_name' => 'AI Assistant',
                'persona_description' => 'Assistant for testing',
            ]);
        }

        // Buat beberapa Lead acak
        $leads = [];
        for ($i = 1; $i <= 3; $i++) {
            $leads[] = Lead::updateOrCreate(
                ['phone' => "08123456780$i"],
                [
                    'persona_id' => $persona->id,
                    'name' => "Lead Testing $i",
                    'source' => 'whatsapp',
                    'last_interaction_at' => Carbon::now()->subHours($i),
                ]
            );
        }

        // Generate sample decisions
        $decisions = [
            [
                'persona_id' => $persona->id,
                'lead_id' => $leads[0]->id,
                'detected_intent' => 'partnership',
                'brand_name' => 'Kopi Kenangan',
                'cooperation_type' => 'Endorsement / Paid Promote',
                'summary' => 'Agensi dari Kopi Kenangan menawarkan kerjasama endorsement untuk produk kopi susu varian baru. Mereka meminta ratecard dan jadwal kosong di bulan depan.',
                'estimated_value' => 'medium',
                'status' => 'needs_review',
                'action_taken_at' => null,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'persona_id' => $persona->id,
                'lead_id' => $leads[1]->id,
                'detected_intent' => 'collaboration',
                'brand_name' => 'Erigo Store',
                'cooperation_type' => 'Brand Ambassador / Long-term',
                'summary' => 'Brand fashion Erigo tertarik untuk mengajak kerjasama jangka panjang sebagai brand ambassador selama 6 bulan. Rencana pemotretan di Jepang.',
                'estimated_value' => 'high',
                'status' => 'interested',
                'action_taken_at' => Carbon::now()->subHours(5),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subHours(5),
            ],
            [
                'persona_id' => $persona->id,
                'lead_id' => $leads[2]->id,
                'detected_intent' => 'event_invitation',
                'brand_name' => 'Jakarta X Beauty',
                'cooperation_type' => 'Guest Star / Speaker',
                'summary' => 'Undangan untuk menjadi pembicara tamu di event Jakarta X Beauty hari ke-2. Membahas tentang peran AI dalam dunia kecantikan.',
                'estimated_value' => 'medium',
                'status' => 'ignore',
                'action_taken_at' => Carbon::now()->subDays(1),
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'persona_id' => $persona->id,
                'lead_id' => $leads[0]->id,
                'detected_intent' => 'partnership',
                'brand_name' => 'Shopee Indonesia',
                'cooperation_type' => 'Affiliate Affiliate Review',
                'summary' => 'Penawaran untuk mereview produk eksklusif dari seller Shopee terpilih dengan komisi affiliate sebesar 15%.',
                'estimated_value' => 'unknown',
                'status' => 'needs_review',
                'action_taken_at' => null,
                'created_at' => Carbon::now()->subHours(12),
                'updated_at' => Carbon::now()->subHours(12),
            ],
        ];

        DecisionInbox::insert($decisions);
        
        $this->command->info('Berhasil menambahkan ' . count($decisions) . ' data dummy Decision Inbox.');
    }
}
