<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * class CategoryService
 */
class CategoryService
{
    /**
     * @var CategoryRepository
     */
    protected CategoryRepository $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->categoryRepository->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
