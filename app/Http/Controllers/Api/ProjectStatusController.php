<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStatusRequest;
use App\Http\Requests\StoreProjectStatusRequest;
use App\Http\Requests\UpdateProjectStatusRequest;
use App\Models\ProjectStatus;
use App\Services\ProjectStatusService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
/**
 * Class ProjectStatusController
 */
class ProjectStatusController extends Controller
{
    /**
     * @var ProjectStatusService
     */
    protected ProjectStatusService $projectStatusService;

    /**
     * @param ProjectStatusService $projectStatusService
     */
    public function __construct(ProjectStatusService $projectStatusService)
    {
        $this->projectStatusService = $projectStatusService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->projectStatusService->getAll());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try{
            $status = $this->projectStatusService->find($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Project status not found'], 404);
        }
        return response()->json($status);
    }

    /**
     * @param UpdateProjectStatusRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProjectStatusRequest $request)
    {
        $validated = $request->validated();
        try{
            $status = $this->projectStatusService->create($validated);
        }catch(\Exception $e) {
            return response()->json(['message' => 'Error on creating project status'.$e->getMessage()], 404);
        }
        return response()->json($status, 201);
    }

    /**
     * @param  UpdateProjectStatusRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectStatusRequest $request, $id)
    {
        $validated = $request->validated();
        try{
            $status = $this->projectStatusService->update($id, $validated);
        }catch(\Exception $e) {
            return response()->json(['message' => 'Error on updating project status'.$e->getMessage()], 404);
        }
        return response()->json($status);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            $this->projectStatusService->delete($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error on deleting project status : '.$e->getMessage()], 404);
        }
        return response()->json(['message' => 'Deleted successfully']);
    }
}
