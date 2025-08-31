<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            ['name' => 'Red', 'hex_value' => '#FF0000'],
            ['name' => 'Blue', 'hex_value' => '#0000FF'],
            ['name' => 'Green', 'hex_value' => '#00FF00'],
            ['name' => 'Black', 'hex_value' => '#000000'],
            ['name' => 'White', 'hex_value' => '#FFFFFF'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
