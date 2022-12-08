<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meal_ingredient')->truncate();
        DB::table('ingredient_translations')->truncate();
        DB::table('ingredients')->truncate();

        Ingredient::factory()
            ->count(50)
            ->create();
    }
}
