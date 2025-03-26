<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Services\admin\StatisticService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StatisticController extends BaseController
{
    
    public function __construct() {
        
    }

    public function index()
    {   
        $limit = 3;
        $data = StatisticService::getInstance()->index($limit);
        
        return $this->sendSuccessResponse($data, 'Success', Response::OK);
    }
}
