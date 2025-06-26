<?php

namespace App\Models;

use App\Observers\ProjectObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
#[ObservedBy([ProjectObserver::class])]
class Project extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'projects';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'project_name',
        'project_nature',
        'project_type_id',
        'project_status_id',
        'start_date',
        'end_date',
        'actual_start_date',
        'total_budget',
        'zakoura_contribution',
        'notes',
        'project_bank_account_id',
        'project_code'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'actual_start_date' => 'date',
        'total_budget' => 'decimal:2', 
        'zakoura_contribution' => 'decimal:2',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectBankAccount(){
        return $this->belongsTo(ProjectBankAccount::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectType(){
        return $this->belongsTo(ProjectType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectStatus(){
        return $this->belongsTo(ProjectStatus::class);
    }
}
