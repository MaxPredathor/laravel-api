<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['php', 'laravel', 'javascript', 'vuejs', 'sass', 'html5', 'bootstrap', 'react'];
        foreach($technologies as $technology){
            $newTecnology = new Technology();
            $newTecnology->name = $technology;
            if($newTecnology->name === 'laravel') {
                $newTecnology->image = 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/'. $technology . '/' . $technology . '-plain.svg';
            }else{
                $newTecnology->image = 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/'. $technology . '/' . $technology . '-original.svg';
            }
            $newTecnology->slug = Str::slug($technology, '-');
            $newTecnology->save();
        }

    }
}
