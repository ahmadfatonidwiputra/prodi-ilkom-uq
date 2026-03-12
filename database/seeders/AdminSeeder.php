<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Keep backward compatibility if AdminSeeder is called directly.
        // Delegate to the single-source-of-truth seeder for admin credentials.
        $this->call(SuperAdminSeeder::class);
    }
}
