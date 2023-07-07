<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected function store(Request $request){
        $user = auth('sanctum')->user();
    
        if (!$user) {
            return response()->json([
                'message' => 'Please log in',
            ]);
        }
        
        $accountId = $user->id;
        $userId = User::where('account_id', $accountId)->first()->id;
        $newinvoice = new Invoice();
        $newinvoice->ticket_id = intval($request->input('ticket_id'));
        $newinvoice->code = $request->input('code');
        $newinvoice->total_price = intval($request->input('total_price'));
        $newinvoice->user_id = $userId;
        $newinvoice->save();
    
    
        return response()->json([
            'message' => 'add invoice successfully',
            'invoice' => $newinvoice,
        ]);
    }
}