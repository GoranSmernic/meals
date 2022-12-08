<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'slug' => "category-{$counter}"
        ];

        $locales = Language::all();

        foreach ($locales as $locale) {
            $data[$locale->lang] = [
                'title' => "Title for category-{$counter} on {$locale->lang} language"
            ];
        }
        
        $counter++;

        return $data;
    }
}
