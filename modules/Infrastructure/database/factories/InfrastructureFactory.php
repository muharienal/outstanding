<?php

namespace Modules\Infrastructure\database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InfrastructureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Infrastructure\app\Models\Infrastructure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /**
         * for title and title slug
         */
        $title = $this->faker->sentence();
        $thumbnail = ['street_1.jpeg', 'street_2.jpeg', 'street_3.jpeg', 'street_4.jpeg', 'street_5.jpeg'];

        return [
            'title' => $title,
            'slug' => str($title)->slug(),
            'thumbnail' => $thumbnail[array_rand($thumbnail, 1)],
            'body' => $this->faker->paragraph(25),
            'user_id' => User::firstWhere('email', 'superadmin@gmail.com')->id,
        ];
    }
}
