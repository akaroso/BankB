<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentStorageResource;
use App\Models\PaymentStorage;
use App\Models\Payment;
use App\Models\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{

    public function index()
    {
        // $transfery = [];
        //  $transfery =  PaymentStorage::all()->with('pivot')->get(); 

        PaymentStorageResource::withoutWrapping();
        $transfers = PaymentStorage::with('Payments')->get();       
        $data =  PaymentStorageResource::collection($transfers);
        $json = $data[0];
        return $json;
    }

    public function session()
    {
        PaymentStorageResource::withoutWrapping();
        $transfers = PaymentStorage::with('Payments')->get();       
        $data =  PaymentStorageResource::collection($transfers);
        $json = $data[0];
        $cos  =$json->toJson();      
        $cos2 = json_decode($cos,true);
        $response = Http::post('http://91.189.216.237:8000/api/session', $cos2);   
        $json2 = $response->json();

         $paymentStorage = PaymentStorage::create([
            'BankNo' => $json2['BankNo'],
            'PaymentSum' => $json2['PaymentSum'],
        ]);

        foreach($json2['Payments'] as $pmt) 
        {
            $paymentStorage->Payments()->create([
                'DebitedAccountNumber' => $pmt['DebitedAccountNumber'],
                'DebitedNameAndAddress' => $pmt['DebitedNameAndAddress'],
                'CreditedAccountNumber' => $pmt['CreditedAccountNumber'],
                'CreditedNameAndAddress' => $pmt['CreditedNameAndAddress'],
                'Title' => $pmt['Title'],
                'Amount' => $pmt['Amount'],
            ]);
        } 

        return $paymentStorage;      
    }


    public function deleteSendedRecords()
    {
        $session = PaymentStorage::first();
        $id = $session->id;
        PaymentStorage::destroy($id);
        return $id;
    }


    public function bankLoad()
    {

        DB::transaction(function () {
            $transfers = PaymentStorage::with('Payments')->get();

            $suma = 0;
            foreach ($transfers as $transfer) {
                $suma += $transfer->PaymentSum;
            }

            $Account2 = Account::first();
            $Account2->balance -= $suma;
            $Account2->save();

            $Account2->operation()->create([
                'type' => 'Sesion out',
                'amount' => -$suma,
                'status' => 'Finalized'
            ]);
        });
        
    }




    public function bankSave()
    {
        DB::transaction(function () {
            $transfers = Payment::all();
            foreach ($transfers as $transfer) {
                $accnumber = $transfer->CreditedAccountNumber;
                $money = $transfer->Amount;

                //tutaj dodac ifa ktory przepuszcza dalej pomimo braku znalezienia konta
                $acc = Account::where('number', $accnumber)->first();
                $acc->balance += $money;
                $acc->save();

                //zapis do operacji po stronie odbiorcy

                $acc->operation()->create([
                    'type' => 'External transfer',
                    'amount' => $money,
                    'status' => 'Finalized'
                ]);

                $Account2 = Account::first();
                $Account2->balance += $money;
                $Account2->save();

                $Account2->operation()->create([
                    'type' => 'Sesion in',
                    'amount' => $money,
                    'status' => 'Finalized'
                ]);
            }
        });
        return $this->deleteSendedRecords();
        // return $transfers;

        
    }

    public function sendSession() 
    {
        $this->bankLoad();
        $this->session();
        $this->deleteSendedRecords();
        $this->bankSave();
        
    }


}
