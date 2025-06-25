<?php

namespace App\Services;

use App\Models\BankAccount;
use App\Repositories\BankAccountRepository;

class BankAccountService
{
    protected $bankAccountRepository;

    public function __construct(BankAccountRepository $bankAccountRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
    }

    public function getAll()
    {
        return $this->bankAccountRepository->all();
    }

    public function find($id)
    {
        return $this->bankAccountRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->bankAccountRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->bankAccountRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->bankAccountRepository->delete($id);
    }
}
