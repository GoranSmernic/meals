<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meal_tag')->truncate();
        DB::table('tag_translations')->truncate();
        DB::table('tags')->truncate();

        Tag::factory()
            ->count(20)
            ->create();
    }
}
