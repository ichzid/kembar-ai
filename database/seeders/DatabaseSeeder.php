<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Urutan seeder SANGAT PENTING:
     * 1. ProgrammerPersonaSeeder → Membuat User & Persona utama
     * 2. DummyDataSeeder         → Membuat Leads, Chat Logs, & Decision Inbox (berdasarkan Persona dari step 1)
     */
    public function run(): void
    {
        $this->call(ProgrammerPersonaSeeder::class);
        $this->call(DummyDataSeeder::class);
    }
}
