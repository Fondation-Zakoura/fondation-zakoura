<?php

namespace App\Services;

use App\Models\BankAccount;
use App\Repositories\BankAccountRepository;

class BankAccountService
{
    /** @var BankAccountRepository */
    protected BankAccountRepository $bankAccountRepository;

    /**
     * @param BankAccountRepository $bankAccountRepository
     */
    public function __construct(BankAccountRepository $bankAccountRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|BankAccount[]
     */
    public function getAll()
    {
        return $this->bankAccountRepository->all();
    }

    /**
     * @param int $id
     * @return BankAccount
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        return $this->bankAccountRepository->find($id);
    }

    /**
     * @param array $data 
     * @return BankAccount 
     */
    public function create(array $data)
    {
        return $this->bankAccountRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data 
     * @return BankAccount 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException 
     */
    public function update($id, array $data)
    {
        return $this->bankAccountRepository->update($id, $data);
    }

    /**
     * @param int $id 
     * @return int
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException 
     */
    public function delete($id)
    {
        return $this->bankAccountRepository->delete($id);
    }
}
