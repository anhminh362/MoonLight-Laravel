<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected function store(Request $request){
        Invoice::create($request->all());
    }
}