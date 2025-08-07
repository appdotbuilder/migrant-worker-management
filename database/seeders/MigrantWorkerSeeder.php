<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\TrainingProgram;
use App\Models\MemberTraining;
use App\Models\FinancialTransaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class MigrantWorkerSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@simtkm.com',
            'role' => 'admin',
        ]);

        // Create staff users
        $registrationStaff = User::factory()->create([
            'name' => 'Staf Pendaftaran',
            'email' => 'registration@simtkm.com',
            'role' => 'registration_staff',
        ]);

        $trainingStaff = User::factory()->create([
            'name' => 'Staf Pelatihan',
            'email' => 'training@simtkm.com',
            'role' => 'training_staff',
        ]);

        $adminStaff = User::factory()->create([
            'name' => 'Staf Administrasi',
            'email' => 'admin.staff@simtkm.com',
            'role' => 'administrative_staff',
        ]);

        $financeStaff = User::factory()->create([
            'name' => 'Staf Keuangan',
            'email' => 'finance@simtkm.com',
            'role' => 'finance_staff',
        ]);

        // Create training programs
        TrainingProgram::factory(8)->create();

        // Create members
        Member::factory(50)->create();

        // Create member trainings
        $members = Member::all();
        $programs = TrainingProgram::all();

        foreach ($members->random(30) as $member) {
            MemberTraining::create([
                'member_id' => $member->id,
                'training_program_id' => $programs->random()->id,
                'start_date' => fake()->dateTimeBetween('-3 months', '+1 month'),
                'end_date' => fake()->dateTimeBetween('+1 month', '+6 months'),
                'status' => fake()->randomElement(['registered', 'ongoing', 'completed', 'dropped']),
                'score' => fake()->optional(0.7)->randomFloat(2, 60, 100),
                'notes' => fake()->optional()->sentence(),
            ]);
        }

        // Create financial transactions
        FinancialTransaction::factory(100)->create([
            'created_by' => $financeStaff->id,
        ]);

        // Create some specific transactions for recent members
        foreach ($members->take(10) as $member) {
            FinancialTransaction::create([
                'transaction_number' => FinancialTransaction::generateTransactionNumber('income'),
                'member_id' => $member->id,
                'type' => 'income',
                'category' => 'Biaya Pendaftaran',
                'description' => 'Biaya pendaftaran anggota ' . $member->full_name,
                'amount' => 500000,
                'transaction_date' => $member->created_at,
                'payment_method' => 'cash',
                'created_by' => $financeStaff->id,
            ]);
        }
    }
}