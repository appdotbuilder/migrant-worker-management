<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_number' => Member::generateMemberNumber(),
            'full_name' => $this->faker->name(),
            'nickname' => $this->faker->optional()->firstName(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birth_date' => $this->faker->dateTimeBetween('-50 years', '-18 years'),
            'birth_place' => $this->faker->city(),
            'address' => $this->faker->address(),
            'village' => $this->faker->city(),
            'district' => $this->faker->city(),
            'city' => $this->faker->city(),
            'province' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->optional()->safeEmail(),
            'religion' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'marital_status' => $this->faker->randomElement(['single', 'married', 'divorced', 'widowed']),
            'education' => $this->faker->randomElement(['elementary', 'junior_high', 'senior_high', 'diploma', 'bachelor', 'master', 'doctor']),
            'profession' => $this->faker->optional()->jobTitle(),
            'height' => $this->faker->randomFloat(2, 150, 190),
            'weight' => $this->faker->randomFloat(2, 45, 100),
            'father_name' => $this->faker->name('male'),
            'mother_name' => $this->faker->name('female'),
            'emergency_contact_name' => $this->faker->name(),
            'emergency_contact_phone' => $this->faker->phoneNumber(),
            'emergency_contact_relation' => $this->faker->randomElement(['Ayah', 'Ibu', 'Suami', 'Istri', 'Anak', 'Saudara']),
            'passport_number' => $this->faker->optional()->regexify('[A-Z]{2}[0-9]{7}'),
            'passport_issue_date' => $this->faker->optional()->dateTimeBetween('-5 years', 'now'),
            'passport_expiry_date' => $this->faker->optional()->dateTimeBetween('now', '+10 years'),
            'passport_issue_place' => $this->faker->optional()->city(),
            'bank_name' => $this->faker->optional()->randomElement(['BRI', 'BCA', 'Mandiri', 'BNI', 'CIMB Niaga']),
            'account_number' => $this->faker->optional()->numerify('##########'),
            'account_holder_name' => $this->faker->optional()->name(),
            'status' => $this->faker->randomElement(['active', 'training', 'deployed', 'returned', 'inactive']),
            'notes' => $this->faker->optional()->text(),
        ];
    }
}