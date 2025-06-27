<?php

namespace App\Repositories;

use App\Models\ProjectBankAccount;

class ProjectBankAccountRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return ProjectBankAccount::all();
    }

    /**
     * @param int $id ID of the bank account to find.
     * @return ProjectBankAccount
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the bank account is not found.
     */
    public function find($id)
    {
        return ProjectBankAccount::findOrFail($id);
    }

    /**

     * @param array $data
     * @return ProjectBankAccount 
     */
    public function create(array $data)
    {
        return ProjectBankAccount::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return ProjectBankAccount
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException 
     */
    public function update($id, array $data)
    {
        $account = $this->find($id);
        $account->update($data);
        return $account;
    }

    /**
     * @param int $id ID of the bank account to delete.
     * @return int The number of affected rows.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the bank account is not found.
     */
    public function delete($id)
    {
        $account = $this->find($id);
        return $account->delete();
    }

    /**
     * @param array $ids An array of bank account IDs to delete.
     * @return int The number of affected rows.
     */
    public function bulkDelete(array $ids)
    {
        return ProjectBankAccount::whereIn('id', $ids)->delete();
    }
}
