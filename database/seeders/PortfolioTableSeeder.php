<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Portfolio;
use Illuminate\Support\Str;

class PortfolioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++) {
            $newPortfolio = new Portfolio();
            $newPortfolio->name = $faker->sentence(4);
            $newPortfolio->slug = Str::slug($newPortfolio->name, '-');
            $newPortfolio->client_name = $faker->word();
            $newPortfolio->summary = $faker->text(600);
            $newPortfolio->save();
        }
    }
}
