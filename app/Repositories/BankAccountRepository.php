<?php

namespace App\Repositories;

use App\Models\BankAccount;

class BankAccountRepository
{
    /**
     * Retrieve all bank accounts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function all()
    {
        return BankAccount::all();
    }



    /**
     * Find a bank account by its ID.
     *
     * @param int $id ID of the bank account to find.
     *
     * @return BankAccount
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the bank account is not found.
     */
    public function find($id)
    {
        return BankAccount::findOrFail($id);
    }
    /**
     * Create a new bank account.
     *
     * @param array $data Data to create the new bank account with.
     *
     * @return BankAccount
     */

    /**
     * Create a new bank account.
     *
     * @param array $data The data to create the bank account with.
     * @return BankAccount The newly created bank account instance.
     */

    /**
     * Create a new bank account.
     *
     * @param array $data The data to create the bank account with.
     *
     * @return BankAccount The newly created bank account instance.
     */
    public function create(array $data)
    {
        return BankAccount::create($data);
    }

    /**
     * Update an existing bank account.
     *
     * @param int $id ID of the bank account to update.
     * @param array $data Data to update the bank account with.
     *
     * @return BankAccount The updated bank account instance.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the bank account is not found.
     */
    public function update($id, array $data)
    {
        $account = $this->find($id);
        $account->update($data);
        return $account;
    }

    /**
     * Delete a bank account by its ID.
     *
     * @param int $id ID of the bank account to delete.
     *
     * @return int The number of affected rows.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the bank account is not found.
     */
    public function delete($id)
    {
        $account = $this->find($id);
        return $account->delete();
    }

    /**
     * Delete multiple bank accounts by their IDs.
     *
     * @param array $ids An array of bank account IDs to delete.
     *
     * @return int The number of affected rows.
     */
    public function bulkDelete(array $ids)
    {
        return BankAccount::whereIn('id', $ids)->delete();
    }
}
