<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MemberTraining
 *
 * @property int $id
 * @property int $member_id
 * @property int $training_program_id
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property string $status
 * @property float|null $score
 * @property string|null $notes
 * @property string|null $certificate_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Member $member
 * @property-read \App\Models\TrainingProgram $trainingProgram
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTraining newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTraining newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTraining query()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTraining whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTraining whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTraining whereTrainingProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTraining whereStatus($value)

 * 
 * @mixin \Eloquent
 */
class MemberTraining extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'member_id',
        'training_program_id',
        'start_date',
        'end_date',
        'status',
        'score',
        'notes',
        'certificate_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'score' => 'decimal:2',
    ];

    /**
     * Get the member that owns the training.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Get the training program.
     */
    public function trainingProgram(): BelongsTo
    {
        return $this->belongsTo(TrainingProgram::class);
    }
}