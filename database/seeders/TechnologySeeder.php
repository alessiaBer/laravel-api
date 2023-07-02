<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = config('technologies');
        foreach ($technologies as $technology) {
            $newTechnology = new Technology();
            $newTechnology->name = $technology['name'];
            $newTechnology->slug = Str::slug($technology);
            $newTechnology->tech_img_url = $technology['tech_img_url'];
            $newTechnology->save();
        }
    }
}
