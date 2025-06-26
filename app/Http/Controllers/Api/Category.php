<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * class Category
 */
class Category extends Controller
{
    /**
     * @var CategoryService
     */
    protected CategoryService $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param Request $request
     * @return Response|JsonResponse
     */
    public function index(): Response|JsonResponse
    {
        $categories = $this->categoryService->getAll();
        try {
            return response()->json([
                'data' => CategoryResource::collection($this->categoryService->getAll()),
                'pagination' => [
                    'total' => $categories->total(),
                    'count' => $categories->count(),
                    'per_page' => $categories->perPage(),
                    'current_page' => $categories->currentPage(),
                    'total_pages' => $categories->lastPage(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error ' . $e->getMessage()], 500);
        }
    }

    /**
     * @param StoreCategoryRequest $request
     * @return Response|JsonResponse
     */
    public function store(StoreCategoryRequest $request): Response|JsonResponse
    {
        try {
            $category = $this->categoryService->create($request->validated());
            return response()->json(new CategoryResource($category), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error ' . $e->getMessage()], 500);
        }
    }

    /**
     * @param $id
     * @return Response|JsonResponse
     */
    public function show($id): Response|JsonResponse
    {
        try {
            $category = $this->categoryService->findById($id);
            return response()->json(new CategoryResource($category));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error ' . $e->getMessage()], 500);
        }
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param $id
     * @return Response|JsonResponse
     */
    public function update(UpdateCategoryRequest $request, $id): Response|JsonResponse
    {
        try {
            $category = $this->categoryService->update($id, $request->validated());
            return response()->json(new CategoryResource($category));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error ' . $e->getMessage()], 500);
        }
    }

    /**
     * @param $id
     * @return Response|JsonResponse
     */
    public function destroy($id): Response|JsonResponse
    {
        try {
            $deleted = $this->categoryService->delete($id);
            if ($deleted) {
                return response()->noContent();
            }
            return response()->json(['info' => 'Delete failed']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'. $e->getMessage()], 500);
        }
    }
}
