<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 */
class UserRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): Builder
    {
        return User::query();
    }

    /**
     * @param int $id 
     * @return \App\Models\User|null 
     */
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @param int $id 
     * @return \App\Models\User 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * @param array $data
     * @return \App\Models\User
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * @param int $id 
     * @param array $data
     * @return bool 
     */
    public function update(int $id, array $data): bool
    {
        $user = $this->findOrFail($id);
        return $user->update($data);
    }

    /**
     * @param int $id 
     * @return bool 
     */
    public function delete(int $id): bool
    {
        $user = $this->findOrFail($id);
        return $user->delete();
    }
}