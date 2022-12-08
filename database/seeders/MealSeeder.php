<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meal_tag')->truncate();
        DB::table('meal_ingredient')->truncate();
        DB::table('meal_translations')->truncate();
        DB::table('meals')->truncate();

        Meal::factory()
            ->count(50)
            ->hasTags(1)
            ->hasIngredients(1)
            ->create();

        $meals = Meal::all();

        foreach ($meals as &$meal) {
            $tags = Tag::all()->random(rand(1, 5));

            foreach ($tags as $tag) {
                $meal->tags()->attach($tag->id);
            }

            $ingredients = Ingredient::all()->random(rand(1, 5));

            foreach ($ingredients as $ingredient) {
                $meal->ingredients()->attach($ingredient->id);
            }
        }
    }
}
