<?php

namespace App\Http\Controllers\User;

use App\Helpers\Response;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\user\ChangeInvoiceStatus;
use App\Models\Invoice;
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
    /**
     * A controller method call the invoice index service logic and return the response
     * 
     * @param \App\Http\Requests\InvoiceRequest
     * @return \App\Helpers\Response
     */
    public function index(InvoiceRequest $request)
    {
        $data = $request->validated();
        $perPage = $data['per_page'] ?? config('default.pagination');
        $invoices = $this->invoiceService->index($data, $perPage);
        
        return $this->sendSuccessResponse($invoices, "Retrieved invoices successfully", Response::OK);
    }
    /**
     * A controller method to return a detail of an invoice
     * 
     * @param int id
     * @return \App\Helpers\Response
     */
    public function detail($id)
    {
        $user = $this->getUser();
        $invoice = $this->invoiceService->withUser($user)->detail($id);

        return $this->sendSuccessResponse($invoice, 'Retrieved invoice successfully', Response::OK);
    }

    public function count(InvoiceRequest $request)
    {   
        $validated = $request->validated();
        $total = Invoice::where('status', $validated['status'])->count();

        return $this->sendSuccessResponse($total, 'Retrieved the number of invoices successfully', Response::OK);
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
