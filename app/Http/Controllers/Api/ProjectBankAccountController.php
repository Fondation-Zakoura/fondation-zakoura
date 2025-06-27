<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectBankAccountService;
use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\StoreProjectBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Http\Requests\UpdateProjectBankAccountRequest;
use Illuminate\Http\Response;
/**
 * Class BankAccountController
 */
class ProjectBankAccountController extends Controller
{
    /**
     * @var ProjectBankAccountService
     */
    protected ProjectBankAccountService $bankAccountService;

    /**
     * @param ProjectBankAccountService $bankAccountService
     */
    public function __construct(ProjectBankAccountService $bankAccountService)
    {
        $this->bankAccountService = $bankAccountService;
    }

    /**
     * @return Response
     */
    public function index()
    {
        return response()->json($this->bankAccountService->getAll());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try{
            $account = $this->bankAccountService->find($id);
            return response()->json($account);
        }catch(\Exception $e) {
            return response()->json(['message' => 'Error On finding project bank account'.$e->getMessage()], 404);
        }
    }

    /**
     * @param StoreProjectBankAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProjectBankAccountRequest $request)
    {
        $account = $this->bankAccountService->create($request->validated());
        return response()->json($account, 201);
    }

    /**
     * @param UpdateProjectBankAccountRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProjectBankAccountRequest $request, $id)
    {
        try{
            $account = $this->bankAccountService->update($id, $request->validated());
            return response()->json($account);
        }catch(\Exception $e) {
            return response()->json(['message' => 'Error on updating bank account'.$e->getMessage()], 404);
        }
    }

    /**
     * @param int $id 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            $deleted = $this->bankAccountService->delete($id);
            return response()->json(['message' => 'Deleted successfully']);
        }catch(\Exception $e) {
            return response()->json(['message' => 'Error on deleting bank account'.$e->getMessage()], 404);
        }  
    }
}
