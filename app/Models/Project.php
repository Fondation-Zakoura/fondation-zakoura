<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth as AuthFacade;

class Project extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_code',
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
        'bank_account_id',
        // 'created_by_user_id' is typically handled by relationships and not mass assigned directly
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'actual_start_date' => 'date',
        'total_budget' => 'decimal:2', // Cast to decimal with 2 places
        'zakoura_contribution' => 'decimal:2',
    ];

    /**
     * Get the user that created the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * Get the responsible user for the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the bank account associated with the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function bankAccount(){
        return $this->belongsTo(BankAccount::class);
    }

    /**
     * Get the project type associated with the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function projectType(){
        return $this->belongsTo(ProjectType::class);
    }

    /**
     * Get the project status associated with the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectStatus(){
        return $this->belongsTo(ProjectStatus::class);
    }
}
