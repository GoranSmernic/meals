<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['title', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'meal_tag', 'meal_id', 'tag_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'meal_ingredient', 'meal_id', 'ingredient_id');
    }
}
