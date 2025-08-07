<?php

namespace Database\Factories;

use App\Models\FinancialTransaction;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialTransaction>
 */
class FinancialTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['income', 'expense']);
        
        $incomeCategories = [
            'Biaya Pendaftaran',
            'Biaya Pelatihan',
            'Biaya Dokumen',
            'Biaya Administrasi',
            'Komisi Penempatan',
        ];

        $expenseCategories = [
            'Gaji Staf',
            'Biaya Operasional',
            'Biaya Pelatihan',
            'Biaya Transport',
            'Biaya Konsumsi',
            'Biaya Sewa',
            'Biaya Utilities',
        ];

        $category = $type === 'income' 
            ? $this->faker->randomElement($incomeCategories)
            : $this->faker->randomElement($expenseCategories);

        return [
            'transaction_number' => FinancialTransaction::generateTransactionNumber($type),
            'member_id' => $this->faker->optional(0.7)->randomElement(Member::pluck('id')->toArray()),
            'type' => $type,
            'category' => $category,
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->numberBetween(50000, 10000000),
            'transaction_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'payment_method' => $this->faker->randomElement(['cash', 'transfer', 'check', 'other']),
            'reference_number' => $this->faker->optional()->regexify('[A-Z0-9]{10}'),
            'notes' => $this->faker->optional()->sentence(),
            'created_by' => User::factory(),
        ];
    }
}