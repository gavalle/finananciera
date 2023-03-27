<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuPAASeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paa = Menu::factory()->createOne([
            "name" => "Gestión del PAA",
            "icon" => "fas fa-wallet",
            "additional_class" => "active",
            "link" => "/",
            "parent_id" => 0,
            "is_separator" => 0,
            "key_permission" => null,
            "ordering" => 0,
        ]);
        Menu::factory()->createOne([
            "name" => "Años",
            "icon" => "far fa-calendar-alt",
            "additional_class" => "active",
            "link" => "/paa/years",
            "parent_id" => $paa->id,
            "is_separator" => 0,
            "key_permission" => 'paa.configurar.years|paa.configurar.years.create|paa.configurar.years.edit|paa.configurar.years.delete',
            "ordering" => 0,
        ]);

        Menu::factory()->createOne([
            "name" => "PAAs",
            "icon" => "fas fa-wallet",
            "additional_class" => null,
            "link" => "/paas",
            "parent_id" => $paa->id,
            "is_separator" => 0,
            // "key_permission" => "paa.configurar.create|paa.configurar.edit|paa.configurar.delete",
            "key_permission" => "",
            "ordering" => 0,
        ]);
    }
}
