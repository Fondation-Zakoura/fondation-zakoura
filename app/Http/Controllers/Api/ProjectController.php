<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

class ProjectController extends Controller
{
    protected $projectService;

    /**
     * ProjectController constructor.
     *
     * @param ProjectService $projectService Automatically injected by Laravel's service container.
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $natureDuProjetOptions = ['Opérationnel', 'Institutionnel', 'Expérimental'];

        $request->validate([
            'name' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'nature' => ['nullable', 'string', Rule::in($natureDuProjetOptions)],
            'partner' => 'nullable|string|max:255',
            'page' => 'nullable|integer|min:1',
        ]);

        $filters = $request->only(['name', 'code', 'nature', 'type', 'partner']);
        $projects = $this->projectService->getProjects($filters);

        return response()->json($projects);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(): JsonResponse
    {
        $users = User::all(['id', 'name']);
        // $partners = Partner::all(['id', 'name']);  // We will uncomment this line when the Partner Model and the pivot table are created
        // for now we'll just return some dummy data for testing
        $partners = [1 => ['id' => 1, 'name' => 'Partner 1'], 2 => ['id' => 2, 'name' => 'Partner 2'], 3 => ['id' => 3, 'name' => 'Partner 3']];
        $natureDuProjetOptions = ['Opérationnel', 'Institutionnel', 'Expérimental'];
        $typeDuProjetOptions = ['Alphabétisation', 'Éducation', 'Formation', 'Sensibilisation'];
        $statutDuProjetOptions = ['Prospection', 'En discussion', 'Convention signée', 'Contrat actif', 'Archivé'];
        $banqueOptions = ['BMCE', 'CIH', 'BOA', 'Attijari'];

        return response()->json([
            'users' => $users,
            'partners' => $partners,
            'project_nature_options' => $natureDuProjetOptions,
            'project_type_options' => $typeDuProjetOptions,
            'project_status_options' => $statutDuProjetOptions,
            'bank_options' => $banqueOptions,
        ]);
    }

    /**
     * Store a newly created project in storage.
     *
     * @param StoreProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        try {
            $responsableId = $validatedData['responsible_id'];
            $bankAccountId = $validatedData['bank_account_id'] ?? [];
            $createdById = $validatedData['created_by_id']; // i will change it to fetch the authenticated user id
            unset($validatedData['responsible_id'], $validatedData['partners']);

            $project = $this->projectService->createProject($validatedData, $responsableId, $bankAccountId,$createdById);

            return response()->json([
                'message' => 'Projet créé avec succès.',
                'project' => $project->load(['createdBy','bankAccount' ,'responsible']), // For now we will just return the created project with createdBy still need (partner,responsable) relationships
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Échec de la création du projet.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get data for editing an existing project (e.g., current project data and dropdown options).
     *
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Project $project): JsonResponse
    {
        $users = User::all(['id', 'name']);
        // $partners = Partner::all(['id', 'name']);
         // for now we'll just return some dummy data for testing
        $partners = [1 => ['id' => 1, 'name' => 'Partner 1'], 2 => ['id' => 2, 'name' => 'Partner 2'], 3 => ['id' => 3, 'name' => 'Partner 3']];
        $natureDuProjetOptions = ['Opérationnel', 'Institutionnel', 'Expérimental'];

        // Load partners with pivot data for the current project
        $project->load('partners');

        return response()->json([
            'project' => $project,
            'users' => $users,
            'partners' => $partners,
            'project_nature_options' => $natureDuProjetOptions,
        ]);
    }

    /**
     *
     * @param UpdateProjectRequest $request
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        dd($request->validated());
        $validatedData = $request->validated();
        try {
            $responsableId = $validatedData['responsable_id'];
            $partnerData = $validatedData['partners'] ?? [];
            unset($validatedData['responsable_id'], $validatedData['partners']);

            $updatedProject = $this->projectService->updateProject($project, $validatedData, $responsableId, $partnerData);

            return response()->json([
                'message' => 'Projet mis à jour avec succès.',
                'project' => $updatedProject->load(['responsable', 'createdBy', 'partners']),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Échec de la mise à jour du projet.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->validate([
            'project_ids' => 'required|array',
            'project_ids.*' => 'exists:projects,id',
        ]);

        try {
            $deletedCount = $this->projectService->deleteProjects($request->input('project_ids'));
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
