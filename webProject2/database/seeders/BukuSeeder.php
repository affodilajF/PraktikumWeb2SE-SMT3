<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {


            Buku::create([
                'judul' => $faker->sentence(6, true),
                'penulis' => $faker->name,
                'harga' => $faker->numberBetween(10000, 100000),
                'tgl_terbit' =>$faker->dateTime(),
            ]);
        }

    }
}


