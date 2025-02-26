<?php

namespace App\Http\Controllers\User;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
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

    public function detail($id)
    {
        $user = $this->getUser();
        $invoice = $this->invoiceService->withUser($user)->detail($id);

        return $invoice;
    }

    public function list(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->get('per_page', 10);
        $
        $invoices = $this->invoiceService->withUser($user)->list($search, $perPage);

        return $this->sendSuccessResponse($invoices, "Retrieved invoices successfully", Response::OK);
        
    }
}
