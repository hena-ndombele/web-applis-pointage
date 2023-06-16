<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Agent;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricule' => $this->faker->numberBetween(1000, 9999),
            'nom' => $this->faker->lastName,
            'postnom' => $this->faker->word,
            'prenom' => $this->faker->firstName,
            'date_n' => $this->faker->date(),
            'numero' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'adresse' => $this->faker->address,
            'direction_id' => $this->faker->numberBetween(2, 6),
            'departement_id' => $this->faker->numberBetween(1, 4),
            'service_id' => $this->faker->numberBetween(1,1),
            'superviseur' => $this->faker->name,
            'date_e' => $this->faker->date(),
            'etat_civil' => $this->faker->randomElement(['Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(ve)']),
            'nombre_e' => $this->faker->numberBetween(0, 10),
            'niveau_etude' => $this->faker->randomElement(['Bac', 'Licence', 'Master', 'Doctorat']),
            'image' => $this->faker->imageUrl(400, 400, 'people'),
            'grade' => $this->faker->word,
            'fonction' => $this->faker->jobTitle,
            'sexe'=>$this->faker->randomElement(['Masculin', 'feminin']),
    
        ];
    }
}
