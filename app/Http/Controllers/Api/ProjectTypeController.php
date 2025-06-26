<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectTypeRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\UpdateProjectTypeRequest;
use App\Services\ProjectTypeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
/**
 * Class ProjectTypeController
 */
class ProjectTypeController extends Controller
{
    /**
     * @var ProjectTypeService
     */
    protected ProjectTypeService $projectTypeService;

    /**
     * @param ProjectTypeService $projectTypeService
     */
    public function __construct(ProjectTypeService $projectTypeService)
    {
        $this->projectTypeService = $projectTypeService;
    }

    public function index()
    {
        return response()->json($this->projectTypeService->getAll());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try{
            $type = $this->projectTypeService->find($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error on finding project type'.$e->getMessage()], 404);
        }
        return response()->json($type);
    }

    /**
     * @param  \app\Http\Requests\StoreProjectTypeRequest  $request
     * @return \Illuminate\Http\JsonResponse 
     */
    public function store(StoreProjectTypeRequest $request)
    {
        $validated = $request->validated();
        try{
            $type = $this->projectTypeService->create($validated);
        }catch(\Exception $e) {
            return response()->json(['message' => 'Error on creating project type'.$e->getMessage()], 404);  
        }
        return response()->json($type, 201);
    }

    /**
     * @param  \app\Http\Requests\UpdateProjectTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProjectTypeRequest $request, $id)
    {
        $validated = $request->validated();
        try{
            $type = $this->projectTypeService->update($id, $validated);
        }catch(\Exception $e) {
            return response()->json(['message' => 'Error on updating project type'.$e->getMessage()], 404);
        }
        return response()->json($type);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            $deleted = $this->projectTypeService->delete($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error on deleting project type'.$e->getMessage()], 404);
        }
        return response()->json(['message' => 'The Service '.$deleted.' has been deleted successfully']);
    }
}
