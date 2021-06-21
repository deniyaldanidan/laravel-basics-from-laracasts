<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gen = ['male', 'female'];
        return [
            'user_id' => 1,
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'country' => $this->faker->country(),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            
            'twitter' => $this->faker->firstName(),
            'instagram' => $this->faker->firstName(),
            
            'birthdate' => $this->faker->date(),
            'occupation' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            
            'about' => $this->faker->realTextBetween($minNbChars=250, $maxNbChars=400),
            'gender' => $gen[rand(0,1)],
            'phone' => $this->faker->phoneNumber()
        ];
    }
}
