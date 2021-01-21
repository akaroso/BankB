<?php

namespace App\Http\Controllers;
use App\Models\PaymentStorage;
use App\Models\Payment;
use App\Models\Account;

use Illuminate\Http\Request;

class TransferController extends Controller
{
    
    public function index()
    {
   // $transfery = [];
    //  $transfery =  PaymentStorage::all()->with('pivot')->get(); 


    $transfers = PaymentStorage::with('payment')->get();
    return  PaymentStorage::with('payment')->get();
                  
         
    }


    public function bankLoad()
    {

        $transfers = PaymentStorage::with('payment')->get();

        $suma = 0;
        foreach ($transfers as $transfer)
        {
            $suma += $transfer->PaymentSum;
        }

        $Account2 = Account::first();
        $Account2->balance -= $suma;
        $Account2->save();

        $Account2->operation()->create([
            'type' => 'External transfer',
            'amount' => -$suma,
            'status' => 'Finalized'
        ]);

        return $suma;

    }


    public function deleteSendedRecords()
    {
        $xd = "xD";
        return $xd;
    }

}
