<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_number')->unique();
            
            // Personal Information
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            $table->string('birth_place');
            $table->text('address');
            $table->string('village');
            $table->string('district');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('religion');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->enum('education', ['elementary', 'junior_high', 'senior_high', 'diploma', 'bachelor', 'master', 'doctor']);
            $table->string('profession')->nullable();
            $table->decimal('height', 5, 2)->comment('Height in cm');
            $table->decimal('weight', 5, 2)->comment('Weight in kg');
            
            // Family Information
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('emergency_contact_relation');
            
            // Passport Information
            $table->string('passport_number')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->string('passport_issue_place')->nullable();
            
            // Bank Information
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_holder_name')->nullable();
            
            // Status
            $table->enum('status', ['active', 'training', 'deployed', 'returned', 'inactive'])->default('active');
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('member_number');
            $table->index('full_name');
            $table->index('status');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};