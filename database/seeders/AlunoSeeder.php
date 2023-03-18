<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alunos;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
 
        // criar 10 registros de Alunos
        for ($i = 0; $i < 10; $i++) {
            Alunos::create([                
                'nome' => $faker->name,
                'serie' => $faker->randomDigit(),
                'ensino' => $faker->word(),
                'turno' => $faker->word(),
                'nome_escola' => $faker->sentence(),
                'rota_id' => '2',
                'cep' => $faker->postcode(),
                'endereco' => $faker->address(),
                'bairro' => $faker->citySuffix(),
                'numero' => $faker->buildingNumber(),
                'complemento' => '',
                'cidade' => $faker->city(),
                'estado' => $faker->state(),
                'hora_ida' => $faker->time(),
                'hora_volta' => $faker->time(),
            ]);
        }


        for ($i = 0; $i < 10; $i++) {
            Alunos::create([                
                'nome' => $faker->name,
                'serie' => $faker->randomDigit(),
                'ensino' => $faker->word(),
                'turno' => $faker->word(),
                'nome_escola' => $faker->sentence(),
                'rota_id' => '1',
                'cep' => $faker->postcode(),
                'endereco' => $faker->address(),
                'bairro' => $faker->citySuffix(),
                'numero' => $faker->buildingNumber(),
                'complemento' => '',
                'cidade' => $faker->city(),
                'estado' => $faker->state(),
                'hora_ida' => $faker->time(),
                'hora_volta' => $faker->time(),
            ]);
        }
    }
}
