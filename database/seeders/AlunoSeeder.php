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
                'turno' => 'Manhã',
                'nome_escola' => $faker->sentence(),
                'rota_id' => '3',
                'cep' => $faker->postcode(),
                'endereco' => $faker->address(),
                'bairro' => $faker->citySuffix(),
                'numero' => $faker->buildingNumber(),
                'complemento' => '',
                'cidade' => $faker->city(),
                'estado' => $faker->state(),
                'hora_ida' => '06:00',
                'hora_volta' => '12:00',
            ]);
        }


        for ($i = 0; $i < 10; $i++) {
            Alunos::create([                
                'nome' => $faker->name,
                'serie' => $faker->randomDigit(),
                'ensino' => $faker->word(),
                'turno' => 'Tarde',
                'nome_escola' => $faker->sentence(),
                'rota_id' => '4',
                'cep' => $faker->postcode(),
                'endereco' => $faker->address(),
                'bairro' => $faker->citySuffix(),
                'numero' => $faker->buildingNumber(),
                'complemento' => '',
                'cidade' => $faker->city(),
                'estado' => $faker->state(),
                'hora_ida' => '13:00',
                'hora_volta' => '17:00',
            ]);
        }


        for ($i = 0; $i < 10; $i++) {
            Alunos::create([                
                'nome' => $faker->name,
                'serie' => $faker->randomDigit(),
                'ensino' => $faker->word(),
                'turno' => 'Noite',
                'nome_escola' => $faker->sentence(),
                'rota_id' => '5',
                'cep' => $faker->postcode(),
                'endereco' => $faker->address(),
                'bairro' => $faker->citySuffix(),
                'numero' => $faker->buildingNumber(),
                'complemento' => '',
                'cidade' => $faker->city(),
                'estado' => $faker->state(),
                'hora_ida' => '13:00',
                'hora_volta' => '17:00',
            ]);
        }
    }
}
