<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title'];

    public function meals()
    {
        return $this->belongsToMany(Meal::class);
    }
}
