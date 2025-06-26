<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BankAccountService;
use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use Illuminate\Http\Response;
/**
 * Class BankAccountController
 */
class BankAccountController extends Controller
{
    /**
     * @var BankAccountService
     */
    protected BankAccountService $bankAccountService;

    /**
     * @param BankAccountService $bankAccountService
     */
    public function __construct(BankAccountService $bankAccountService)
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
            return response()->json(['message' => 'Error On finding bank account'.$e->getMessage()], 404);
        }
    }

    /**
     * @param StoreBankAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBankAccountRequest $request)
    {
        $account = $this->bankAccountService->create($request->validated());
        return response()->json($account, 201);
    }

    /**
     * @param UpdateBankAccountRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBankAccountRequest $request, $id)
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
