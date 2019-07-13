<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('products')->insert([
                'name' => $faker->name,
                'url' => $faker->slug,
                'image' => $faker->word,
                'content' => $faker->text,
                'price' => 12.2,
                'cat_id' => $faker->randomDigit,
                'stock' => 1,
                'active' => 1
            ]);
        }
    }
}
