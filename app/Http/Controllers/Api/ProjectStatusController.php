<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectStatusService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectStatusController extends Controller
{
    protected $service;

    /**
     *
     * @param ProjectStatusService $service
     */
    public function __construct(ProjectStatusService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->service->getAll());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $status = $this->service->find($id);
        if (!$status) {
            return response()->json(['message' => 'Project status not found'], 404);
        }
        return response()->json($status);
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $status = $this->service->create($validated);
        return response()->json($status, 201);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $status = $this->service->update($id, $validated);
        if (!$status) {
            return response()->json(['message' => 'Project status not found'], 404);
        }
        return response()->json($status);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return response()->json(['message' => 'Project status not found'], 404);
        }
        return response()->json(['message' => 'Deleted successfully']);
    }
}
