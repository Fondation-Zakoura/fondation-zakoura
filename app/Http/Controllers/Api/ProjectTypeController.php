<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectTypeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectTypeController extends Controller
{
    protected $service;

    /**
     *
     * @param ProjectTypeService $service
     */
    public function __construct(ProjectTypeService $service)
    {
        $this->service = $service;
    }



    public function index()
    {
        return response()->json($this->service->getAll());
    }

    /**
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse The project type data or an error message if not found.
     */

    public function show($id)
    {
        $type = $this->service->find($id);
        if (!$type) {
            return response()->json(['message' => 'Project type not found'], 404);
        }
        return response()->json($type);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse The created project type data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $type = $this->service->create($validated);
        return response()->json($type, 201);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $type = $this->service->update($id, $validated);
        if (!$type) {
            return response()->json(['message' => 'Project type not found'], 404);
        }
        return response()->json($type);
    }

    /**
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse 
     */
    public function destroy($id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return response()->json(['message' => 'Project type not found'], 404);
        }
        return response()->json(['message' => 'Deleted successfully']);
    }
}
