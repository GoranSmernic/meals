<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
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
            'slug' => "ingredient-{$counter}"
        ];

        $locales = Language::all();

        foreach ($locales as $locale) {
            $data[$locale->lang] = [
                'title' => "Title for ingredient-{$counter} on {$locale->lang} language"
            ];
        }
        
        $counter++;

        return $data;
    }
}
