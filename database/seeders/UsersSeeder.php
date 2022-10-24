<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*User::factory()->create([
            'name' => 'Emmanuelle Vo',
            'slug' => Str::slug('Emmanuelle Vo'),
            'email' => 'emmanuelle.vo@student.hepl.be',
            'password' => bcrypt('password'),
            'is_admin' => true,

        ]);*/

        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $name = $i > 0 ? strtolower($faker->name()) : 'Emmanuelle Vo';
            $slug = Str::slug($name);
            $is_admin = $i > 0 ? false : true;
            $avatar = $faker->imageUrl(128, 128, true, 'people', $name);
            $email = $i > 0 ? $faker->unique()->safeEmail : 'emmanuelle.vo@student.hepl.be';
            $password = bcrypt('password');
            User::create(
                compact('name', 'is_admin', 'slug', 'avatar', 'email', 'password')
            );
        }
    }
}
