<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectStatus extends Model
{
    protected $table = 'project_statuses';

    protected $fillable = ['name'];

    /**
     * Get the projects for this status.
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'project_status_id');
    }

    /**
     * Scope a query to only include a specific status name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, $name)
    {
        // We use the where method to filter the query to only include records
        // where the name column matches the provided name.
        return $query->where('name', $name);
    }
}
