<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;

class ProjectTechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recupera tutti i project e le technologies
        $projects = Project::all();
        $technologies = Technology::all()->pluck('id')->toArray(); // Prendi solo gli ID delle tecnologie

        foreach ($projects as $project) {
            // Genera un numero casuale di tecnologie da associare (da 0 a 3)
            $numTechnologies = rand(0, 3);

            if ($numTechnologies > 0) {
                // Prendi un numero casuale di tecnologie senza duplicati
                $randomTechnologiesIndexes = array_rand($technologies, $numTechnologies);

                // Se array_rand restituisce un solo elemento, lo converte in array
                $randomTechnologiesIndexes = is_array($randomTechnologiesIndexes) ? $randomTechnologiesIndexes : [$randomTechnologiesIndexes];

                // Usa gli ID corrispondenti agli indici selezionati
                $randomTechnologies = array_map(fn($index) => $technologies[$index], $randomTechnologiesIndexes);

                // Associa le tecnologie al progetto
                $project->technologies()->attach($randomTechnologies);
            }
        }
    }
}
