<?php

namespace App\Http\Controllers\User;

use App\Helpers\Response;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\user\ChangeInvoiceStatus;
use App\Services\user\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends BaseController
{   
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;    
    }

    public function getUser()
    {
        return $this->guard()->user();
    }

    public function index(InvoiceRequest $request)
    {
        $data = $request->validated();
        $perPage = $data['per_page'] ?? config('default.pagination');
        $invoices = $this->invoiceService->index($data, $perPage);

        return $this->sendSuccessResponse($invoices, "Retrieved invoices successfully", Response::OK);
    }

    public function detail($id)
    {
        $user = $this->getUser();
        $invoice = $this->invoiceService->withUser($user)->detail($id);

        return $invoice;
    }

    public function updateInvoiceStatus(ChangeInvoiceStatus $request)
    {
        $validated = $request->validated();
        $updatedInvoice = $this->invoiceService->updateInvoiceStatus($validated);

        return $this->sendSuccessResponse($updatedInvoice, "Updated invoice status successfully", Response::OK);
    }

    public function list(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->get('per_page', 10);
        $invoices = $this->invoiceService->withUser($this->getUser())->list($search, $perPage);

        return $this->sendSuccessResponse($invoices, "Retrieved invoices successfully", Response::OK);
    }
}
