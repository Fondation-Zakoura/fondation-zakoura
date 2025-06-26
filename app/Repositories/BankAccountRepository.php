<?php

namespace App\Repositories;

use App\Models\BankAccount;

class BankAccountRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return BankAccount::all();
    }

    /**
     * @param int $id ID of the bank account to find.
     * @return BankAccount
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the bank account is not found.
     */
    public function find($id)
    {
        return BankAccount::findOrFail($id);
    }

    /**

     * @param array $data
     * @return BankAccount 
     */
    public function create(array $data)
    {
        return BankAccount::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return BankAccount
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
        return BankAccount::whereIn('id', $ids)->delete();
    }
}
