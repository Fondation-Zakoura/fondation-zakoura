<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BankAccountService;
use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use Illuminate\Http\Response;

class BankAccountController extends Controller
{
    protected $service;

    /**
     *
     * @param BankAccountService $service
     */
    public function __construct(BankAccountService $service)
    {
        $this->service = $service;
    }

    /**
     *
     * @return Response
     */
    public function index()
    {
        return response()->json($this->service->getAll());
    }

    /**
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        $account = $this->service->find($id);
        if (!$account) {
            return response()->json(['message' => 'Bank account not found'], 404);
        }
        return response()->json($account);
    }

    /**
     *
     * @param StoreBankAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(StoreBankAccountRequest $request)
    {
        $account = $this->service->create($request->validated());
        return response()->json($account, 201);
    }

    /**
     * @param UpdateBankAccountRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(UpdateBankAccountRequest $request, $id)
    {
        $account = $this->service->update($id, $request->validated());
        if (!$account) {
            return response()->json(['message' => 'Bank account not found'], 404);
        }
        return response()->json($account);
    }

    /**
     *
     * @param int $id 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return response()->json(['message' => 'Bank account not found'], 404);
        }
        return response()->json(['message' => 'Deleted successfully']);
    }
}
