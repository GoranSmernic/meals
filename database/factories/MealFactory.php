<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $counter = 1;

        $data = [
            'slug' => "meal-{$counter}",
            'category_id' => $this->faker->boolean() ? Category::all()->random()->id : null
        ];

        $locales = Language::all();

        foreach ($locales as $locale) {
            $data[$locale->lang] = [
                'title' => "Title for meal-{$counter} on {$locale->lang} language",
                'description' => "Description for meal-{$counter} on {$locale->lang} language",
            ];
        }

        $counter++;

        return $data;
    }
}
