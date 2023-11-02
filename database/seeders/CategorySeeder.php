<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demo_categories = [
            'Honey',
            'Natural Oil',
            'Nuts',
            'Cocunut',
            'Butter',
        ];

        foreach ($demo_categories as $value) {
            Category::create([
                'title' => $value,
                'slug' => Str::slug($value),
            ]);
        }
    }
}
