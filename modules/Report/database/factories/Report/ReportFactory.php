<?php

namespace Modules\Report\database\factories\Report;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Report\app\Models\Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /**
         * status
         */
        $status = ['Pending', 'Processed', 'Accepted', 'Rejected', 'Closed'];

        return [
            'title' => $this->faker->sentence(),
            'attach' => json_encode([]),
            'description' => $this->faker->paragraph(),
            'user_id' => User::firstWhere('email', 'user@gmail.com')->id,
            'status' => $status[array_rand($status, 1)],
        ];
    }
}
