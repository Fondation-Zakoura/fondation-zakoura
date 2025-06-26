<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectBankAccount extends Model
{
    protected $table = 'project_bank_accounts';

    protected $fillable = [
        'rib',
        'bank',
        'agency',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
