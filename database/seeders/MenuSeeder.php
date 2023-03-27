<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::query()->truncate();
        $Dashboard = Menu::factory()->createOne([
            "name" => "Dashboard",
            "icon" => "fa-tachometer-alt",
            "additional_class" => "active",
            "link" => "/",
            "parent_id" => 0,
            "is_separator" => 0,
            "key_permission" => null,
            "ordering" => 0,
        ]);

        Menu::factory()->createOne([
            "name" => "Inicio",
            "icon" => "fa-tachometer-alt",
            "additional_class" => "active",
            "link" => "/",
            "parent_id" => $Dashboard->id,
            "is_separator" => 0,
            "key_permission" => null,
            "ordering" => 0,
        ]);

        $Config = Menu::factory()->createOne([
            "name" => "Configuración",
            "icon" => "fa-copy",
            "additional_class" => null,
            "link" => "#conv",
            "parent_id" => 0,
            "is_separator" => 0,
            "key_permission" => "paa.configurar.funcionario.financiera|paa.configurar.funcionario.planificacion|paa.configurar.funcionario.visto-bueno",
            "ordering" => 0,
        ]);

        Menu::factory()->createOne([
            "name" => "Funcionario Financiera",
            "icon" => "fa-copy",
            "additional_class" => null,
            "link" => "/configurar/funcionario-financiera",
            "parent_id" => $Config->id,
            "is_separator" => 0,
            "key_permission" => "paa.configurar.funcionario.financiera",
            "ordering" => 0,
        ]);
        Menu::factory()->createOne([
            "name" => "Funcionario Planificación",
            "icon" => "fa-copy",
            "additional_class" => null,
            "link" => "/configurar/funcionario-planeacion",
            "parent_id" => $Config->id,
            "is_separator" => 0,
            "key_permission" => "paa.configurar.funcionario.planificacion",
            "ordering" => 0,
        ]);
        Menu::factory()->createOne([
            "name" => "Funcionario Visto Bueno",
            "icon" => "fa-copy",
            "additional_class" => null,
            "link" => "/configurar/funcionario-visto-bueno",
            "parent_id" => $Config->id,
            "is_separator" => 0,
            "key_permission" => "paa.configurar.funcionario.visto-bueno",
            "ordering" => 0,
        ]);
    }
}
