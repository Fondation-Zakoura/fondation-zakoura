<?php

namespace App\Services;

use App\Models\ProjectBankAccount;
use App\Repositories\ProjectBankAccountRepository;

class ProjectBankAccountService
{
    /** @var ProjectBankAccountRepository */
    protected ProjectBankAccountRepository $bankAccountRepository;

    /**
     * @param ProjectBankAccountRepository $bankAccountRepository
     */
    public function __construct(ProjectBankAccountRepository $bankAccountRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|ProjectBankAccount[]
     */
    public function getAll()
    {
        return $this->bankAccountRepository->all();
    }

    /**
     * @param int $id
     * @return ProjectBankAccount
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        return $this->bankAccountRepository->find($id);
    }

    /**
     * @param array $data 
     * @return ProjectBankAccount 
     */
    public function create(array $data)
    {
        return $this->bankAccountRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data 
     * @return ProjectBankAccount 
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
