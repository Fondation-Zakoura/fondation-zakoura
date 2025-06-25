<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankAccount extends Model
{
    protected $table = 'bank_accounts';

    protected $fillable = [
        'partner_id',
        'account_id',
        'account_label',
        'bank',
        'agency',
        'country',
        'currency',
        'account_holder',
        'rib_iban',
        'bic_swift',
        'opening_date',
        'status',
        'supporting_document',
        'comments',
        'created_by',
    ];

    /**
     * Get the partner associated with the bank account.
     */
    public function partner()
    {
        return;
        // return $this->belongsTo(Partner::class);
    }

    /**
     * Get the user who created the bank account.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope a query to only include bank accounts with a specific status.
     *
     * This method is useful when filtering bank accounts by their status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get the projects associated with the bank account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(){
        return $this->hasMany(Project::class);
    }
}
