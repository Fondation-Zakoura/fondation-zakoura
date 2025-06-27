<?php

namespace App\Repositories;


use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * class CategoryRepository
 */
class CategoryRepository
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Category::paginate(1);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Category::findOrFail($id);
        return Category::with('products')->findOrFail($id); // en stand by
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Category::create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $category = $this->find($id);
        return $category->delete();
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function bulkDelete(array $ids)
    {
        return Category::whereIn('id', $ids)->delete();
    }
}
