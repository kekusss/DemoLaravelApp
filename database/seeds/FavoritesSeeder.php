<?php

use App\User as User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FavoritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * adds random products to favorites for random users
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        for($i=0; $i<50; $i++) {
            DB::table('favorites')->insert([
                'user_id' => $faker->randomElement(User::all('id'))['id'],
                'product_id' => $faker->numberBetween(1, 325),
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]);
        }
    }
}
