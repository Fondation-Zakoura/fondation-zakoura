<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Repositories\ProjectRepository;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Get a list of projects with optional filters.
     *
     * @param array $filters An associative array of filters (e.g., 'name', 'code', 'nature', 'type').
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProjects(array $filters = [])
    {
        $query = $this->projectRepository->all()->toQuery();

        // Apply filters
        if (isset($filters['name']) && $filters['name']) {
            $query->byName($filters['name']);
        }
        if (isset($filters['code']) && $filters['code']) {
            $query->byCode($filters['code']);
        }
        if (isset($filters['nature']) && $filters['nature']) {
            $query->byNature($filters['nature']);
        }
        if (isset($filters['type']) && $filters['type']) {
            $query->byType($filters['type']);
        }

        // You might want to add pagination here
        return $query->with(['responsible', 'createdBy', 'bankAccount','projectType','projectStatus'])->paginate(10); // Example: 10 items per page
    }

    /**
     * Create a new project.
     *
     * @param array $data Data for the new project.
     * @param int|null $responsableId ID of the responsible user.
     * @param int|null $compteBancaireId ID of the bank account.
     * @return Project
     * @throws Exception If an error occurs during project creation.
     */
    public function createProject(array $data, ?int $responsableId, ?int $compteBancaireId = null, $createdById): Project
    {
        DB::beginTransaction();
        try {
            $project = new Project($data);

            if ($responsableId) {
                $project->responsible()->associate($responsableId);
            }

            if ($compteBancaireId) {
                $project->bank_account_id = $compteBancaireId;
            }
            if($createdById){
                $project->createdBy()->associate($createdById);
            }
            $project->save();

            DB::commit();
            return $project;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating project: ' . $e->getMessage(), ['exception' => $e]);
            throw new Exception("Échec de la création du projet : " . $e->getMessage());
        }
    }

    /**
     * Update an existing project.
     *
     * @param Project $project The project instance to update.
     * @param array $data Data to update the project with.
     * @param int|null $responsableId ID of the responsible user.
     * @param int|null $compteBancaireId ID of the bank account.
     * @return Project
     * @throws Exception If an error occurs during project update.
     */
    public function updateProject(Project $project, array $data, ?int $responsableId, ?int $compteBancaireId = null): Project
    {
        DB::beginTransaction();
        try {
            $project->fill($data);

            // Update the responsible user
            if ($responsableId) {
                $project->responsable()->associate($responsableId);
            } else {
                $project->responsable()->dissociate(); // If responsible is removed
            }

            if ($compteBancaireId) {
                $project->id_compte_bancaire = $compteBancaireId;
            } else {
                $project->id_compte_bancaire = null;
            }

            $project->save();

            DB::commit();
            return $project;
        } catch (Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            Log::error('Error updating project: ' . $e->getMessage(), ['exception' => $e]);
            throw new Exception("Échec de la mise à jour du projet : " . $e->getMessage());
        }
    }

    /**
     * Delete one or more projects.
     *
     * @param array $projectIds Array of project IDs to delete.
     * @return int Number of projects deleted.
     * @throws Exception If an error occurs during project deletion.
     */
    public function deleteProjects(array $projectIds): int
    {
        return $this->projectRepository->bulkDelete($projectIds);
    }

    /**
     * Get project statistics.
     *
     * @return array
     */
    public function getProjectStats(): array
    {
        return [
            'total_projects' => Project::count(),
            'active_projects' => Project::where('statut_du_projet', 'Contrat actif')->count(),
            'completed_projects' => Project::where('statut_du_projet', 'Archivé')->count(),
            'total_budget' => Project::sum('budget_total'),
        ];
    }

    /**
     * Get projects by status.
     *
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProjectsByStatus(string $status): Collection
    {
        return Project::where('statut_du_projet', $status)
            ->with(['responsable', 'createdBy', 'compteBancaire'])
            ->get();
    }
}
