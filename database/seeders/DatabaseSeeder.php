<?php

namespace Database\Seeders;

use App\Models\Brand;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Category::factory()->count(30)->create();
        SubCategory::factory()->count(30)->create();
        Brand::factory()->count(30)->create();

        $faker = Faker::create();
        $products = [];

        for ($i = 1; $i <= 30; $i++) {
            $products[] = [
                'title' => $faker->unique()->name(),
                'slug' => $faker->unique()->slug(),
                'description' => $faker->text(200),
                'category_id' => rand(1, 28),
                'sub_category_id' => rand(1, 28),
                'brand_id' => rand(1, 28),
                'price' => $faker->randomFloat(2, 50, 500),
                'compare_price' => $faker->randomFloat(2, 60, 600),
                'is_featured' => $faker->randomElement(['yes', 'no']),
                'track_qty' => $faker->randomElement(['yes', 'no']),
                'sku' => 'SKU00' . $i,
                'qty' => $faker->numberBetween(1, 100),
                'showhome' => $faker->randomElement(['yes', 'no']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($products);
    }
}
