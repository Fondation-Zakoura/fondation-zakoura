<?php

namespace App\Observers;

use App\Models\Project;
use Carbon\Carbon;
/**
 * Class ProjectObserver
 */
class ProjectObserver
{

    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        $year = $project->created_at->year; 
        $id = $project->id;
        $paddedId = str_pad($id, 4, '0', STR_PAD_LEFT);
        $project->project_code = "PROJ-{$year}-{$paddedId}"; 
        Project::withoutEvents(fn () => $project->save());
    }
    
    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     */
    public function restored(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     */
    public function forceDeleted(Project $project): void
    {
        //
    }
}
