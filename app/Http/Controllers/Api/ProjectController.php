<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyProjectRequest;
use App\Models\Project;
use App\Models\User; // Assuming User model is in App\Models
use App\Models\Partner; // Assuming Partner model is in App\Models
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Import for Rule::in
use App\Http\Requests\StoreProjectRequest; // Import the new StoreProjectRequest
use App\Http\Requests\UpdateProjectRequest;
use Exception;
use Illuminate\Http\JsonResponse;
/**
 * class ProjectController
 */
class ProjectController extends Controller
{
    /**
     * @var ProjectService
     */
    protected ProjectService $projectService;
    /**
     * @param ProjectService $projectService
     */
    protected $natureDuProjetOptions = ['Opérationnel', 'Institutionnel', 'Expérimental'];
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $projects = $this->projectService->getProjects();
        return response()->json($projects);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(): JsonResponse
    {
        return response()->json([
            'project_nature_options' => $this->natureDuProjetOptions,
        ]);
    }

    /**
     * @param StoreProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        try {
            $responsableId = $validatedData['responsible_id'];
            $bankAccountId = $validatedData['bank_account_id'] ?? [];
            $createdById = $validatedData['created_by_id']; // later
            unset($validatedData['responsible_id'], $validatedData['partners']);

            $project = $this->projectService->createProject($validatedData, $responsableId, $bankAccountId,$createdById);
            return response()->json([
                'message' => 'Projet créé avec succès.',
                'project' => $project->load(['createdBy','bankAccount' ,'responsible']), // later
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Échec de la création du projet.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Project $project): JsonResponse
    {
        $users = User::all(['id', 'name']);
        $partners = [1 => ['id' => 1, 'name' => 'Partner 1'], 2 => ['id' => 2, 'name' => 'Partner 2'], 3 => ['id' => 3, 'name' => 'Partner 3']];
        // later
        return response()->json([
            'project' => $project,
            'users' => $users,
            'partners' => $partners,
            'project_nature_options' => $this->natureDuProjetOptions,
        ]);
    }
    /**
     * @param UpdateProjectRequest $request
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $validatedData = $request->validated();
        try {
            $responsableId = $validatedData['responsible_id'];
            $bankAccountId = $validatedData['bank_account_id'] ?? [];
            unset($validatedData['responsible_id'], $validatedData['bank_account_id']);
            $updatedProject = $this->projectService->updateProject($project, $validatedData, $responsableId, $bankAccountId);

            return response()->json([
                'message' => 'Projet mis à jour avec succès.',
                'project' => $updatedProject->load(['responsible', 'createdBy', 'bankAccount']),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Échec de la mise à jour du projet.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @param DestroyProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyProjectRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $deletedCount = $this->projectService->deleteProjects($validated['project_ids']);
            return response()->json([
                'message' => "{$deletedCount} projet(s) supprimé(s) avec succès.",
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Échec de la suppression des projets.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}
