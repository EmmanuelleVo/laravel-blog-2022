<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();

        $title = $faker->sentence(10);
        $created_at = Carbon::create($faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d H:i:s'));


        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $faker->sentence(40),
            'body' => '<p>' . implode('</p><p>', $faker->paragraphs(7)) . '</p>',
            'thumbnail' => $faker->imageUrl(640, 480, true, 'landscape'),
            'user_id' => User::factory(),
            'created_at' => $created_at,
            'published_at' => $created_at->addDays(rand(0, 1) * rand(2, 20)),
            'updated_at' => rand(0, 10) ? $created_at : $created_at->addWeeks(rand(2, 8)),
            'deleted_at' => rand(0, 10) ? null : Carbon::now(),
        ];
    }
}
