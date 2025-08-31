<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    public function run(): void
    {
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];

        foreach ($sizes as $size) {
            Size::create(['name' => $size]);
        }
    }
}
