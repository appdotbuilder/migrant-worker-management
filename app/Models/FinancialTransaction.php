<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\FinancialTransaction
 *
 * @property int $id
 * @property string $transaction_number
 * @property int|null $member_id
 * @property string $type
 * @property string $category
 * @property string $description
 * @property float $amount
 * @property \Illuminate\Support\Carbon $transaction_date
 * @property string $payment_method
 * @property string|null $reference_number
 * @property string|null $notes
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Member|null $member
 * @property-read \App\Models\User $creator
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialTransaction whereTransactionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialTransaction income()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialTransaction expense()
 * @method static \Database\Factories\FinancialTransactionFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class FinancialTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'transaction_number',
        'member_id',
        'type',
        'category',
        'description',
        'amount',
        'transaction_date',
        'payment_method',
        'reference_number',
        'notes',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    /**
     * Get the member associated with the transaction.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Get the user who created the transaction.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope a query to only include income transactions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    /**
     * Scope a query to only include expense transactions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    /**
     * Generate a unique transaction number.
     *
     * @param string $type
     * @return string
     */
    public static function generateTransactionNumber(string $type): string
    {
        $prefix = $type === 'income' ? 'IN' : 'OUT';
        $year = date('Y');
        $month = date('m');
        
        $lastTransaction = self::where('type', $type)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastTransaction) {
            $lastNumber = (int) substr($lastTransaction->transaction_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . $year . $month . str_pad((string) $newNumber, 4, '0', STR_PAD_LEFT);
    }
}