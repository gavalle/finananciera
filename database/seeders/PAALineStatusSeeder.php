<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PAAStatus;
use App\Models\PAALineStatus;

class PAALineStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PAAStatus::factory()->createOne([
            "name" => "CREADO",
            "description" => "PAA Creado",
            "created_by" => 1,
            "created_at" => now(),
        ]);

        PAALineStatus::factory()->createOne([
            "name" => "CREADA",
            "description" => "Línea del PAA Creada",
            "created_by" => 1,
            "created_at" => now(),
        ]);
    }
}
