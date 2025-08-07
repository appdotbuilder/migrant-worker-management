<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Member
 *
 * @property int $id
 * @property string $member_number
 * @property string $full_name
 * @property string|null $nickname
 * @property string $gender
 * @property \Illuminate\Support\Carbon $birth_date
 * @property string $birth_place
 * @property string $address
 * @property string $village
 * @property string $district
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $phone
 * @property string|null $email
 * @property string $religion
 * @property string $marital_status
 * @property string $education
 * @property string|null $profession
 * @property float $height
 * @property float $weight
 * @property string $father_name
 * @property string $mother_name
 * @property string $emergency_contact_name
 * @property string $emergency_contact_phone
 * @property string $emergency_contact_relation
 * @property string|null $passport_number
 * @property \Illuminate\Support\Carbon|null $passport_issue_date
 * @property \Illuminate\Support\Carbon|null $passport_expiry_date
 * @property string|null $passport_issue_place
 * @property string|null $bank_name
 * @property string|null $account_number
 * @property string|null $account_holder_name
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MemberTraining> $trainings
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FinancialTransaction> $transactions
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereMemberNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member active()
 * @method static \Database\Factories\MemberFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'member_number',
        'full_name',
        'nickname',
        'gender',
        'birth_date',
        'birth_place',
        'address',
        'village',
        'district',
        'city',
        'province',
        'postal_code',
        'phone',
        'email',
        'religion',
        'marital_status',
        'education',
        'profession',
        'height',
        'weight',
        'father_name',
        'mother_name',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
        'passport_number',
        'passport_issue_date',
        'passport_expiry_date',
        'passport_issue_place',
        'bank_name',
        'account_number',
        'account_holder_name',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'passport_issue_date' => 'date',
        'passport_expiry_date' => 'date',
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    /**
     * Get the member's trainings.
     */
    public function trainings(): HasMany
    {
        return $this->hasMany(MemberTraining::class);
    }

    /**
     * Get the member's documents.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get the member's financial transactions.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    /**
     * Scope a query to only include active members.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Generate a unique member number.
     *
     * @return string
     */
    public static function generateMemberNumber(): string
    {
        $year = date('Y');
        $lastMember = self::whereYear('created_at', $year)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastMember) {
            $lastNumber = (int) substr($lastMember->member_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'TKM' . $year . str_pad((string) $newNumber, 4, '0', STR_PAD_LEFT);
    }
}