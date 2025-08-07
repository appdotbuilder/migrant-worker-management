<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingProgram>
 */
class TrainingProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $programs = [
            'Pelatihan Pembantu Rumah Tangga',
            'Pelatihan Perawat Lansia',
            'Pelatihan Baby Sitter',
            'Pelatihan Supir',
            'Pelatihan Cleaning Service',
            'Pelatihan Tukang Kebun',
            'Pelatihan Koki',
            'Pelatihan Operator Pabrik',
        ];

        $programName = $this->faker->randomElement($programs);
        $programCode = 'TRN' . $this->faker->unique()->numberBetween(1000, 9999);

        return [
            'program_code' => $programCode,
            'program_name' => $programName,
            'description' => $this->faker->paragraph(3),
            'duration_days' => $this->faker->numberBetween(7, 90),
            'cost' => $this->faker->numberBetween(500000, 5000000),
            'certification' => $this->faker->optional()->sentence(3),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}