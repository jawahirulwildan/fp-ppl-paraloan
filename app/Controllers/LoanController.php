<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoanController extends BaseController
{
    public function index()
    {
        return view('request_loan');
    }
}
