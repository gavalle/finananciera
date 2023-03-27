<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PAAYear;

class PAAYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PAAYear::factory()->createOne([
            "cod" => "2023",
            "description" => "Configuración del año 2023",
            "start_date_hiring" => "2023-01-01 00:00:00",
            "end_date_hiring" => "2023-03-30 23:59:59",
            "active" => 1,
            "created_by" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);
    }
}
