<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class InvoiceController extends BaseController
{
    public function index()
    {
        return view('request_loan');
    }
}
