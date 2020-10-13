<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'owner_id' => function() {
                $uf = \App\Models\User::factory()->create();
                return $uf->id;
            }
        ];

//        return [
//            'title' =>'ffff',
//            'description' => 'fdsgsdgsg',
//            'owner_id' => 2,
//        ];

//        return [
//            'title' => 'efwe',
//            'description' => 'sdgsdg'
//        ];

//        return [
//            'title' => Str::random(5),
//            'description' => Str::random(10),
//        ];
    }
}
