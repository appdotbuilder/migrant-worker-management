<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\TrainingProgram
 *
 * @property int $id
 * @property string $program_code
 * @property string $program_name
 * @property string $description
 * @property int $duration_days
 * @property float $cost
 * @property string|null $certification
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MemberTraining> $memberTrainings
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingProgram whereProgramCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingProgram whereProgramName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingProgram whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingProgram active()
 * @method static \Database\Factories\TrainingProgramFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class TrainingProgram extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'program_code',
        'program_name',
        'description',
        'duration_days',
        'cost',
        'certification',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cost' => 'decimal:2',
        'duration_days' => 'integer',
    ];

    /**
     * Get the training program's member trainings.
     */
    public function memberTrainings(): HasMany
    {
        return $this->hasMany(MemberTraining::class);
    }

    /**
     * Scope a query to only include active training programs.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}