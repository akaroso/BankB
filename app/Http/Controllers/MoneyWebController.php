<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Operation;
use App\Models\PaymentStorage;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Exception;

class MoneyWebController extends Controller
{


    public function depositMoney(Request $request)

    {
        $id = $request->get('id');
        $suma = $request->get('balance');

        DB::transaction(function () use ($id, $suma) {


            $Account = Account::findOrFail($id);

            $Account->balance += $suma;
            $Account->save();
            //  $Account->update($request->all());

            //zapis do operacji po stronie nadawcy

            //wplyw na konto glowne
            $Account2 = Account::first();
            $Account2->balance += $suma;
            $Account2->save();

            $Account2->operation()->create([
                'type' => 'Deposit',
                'amount' => $suma,
                'status' => 'Finalized'

            ]);

            //zapis do operacji po stronie odbiorcy

            $Account->operation()->create([
                'type' => 'Deposit',
                'amount' => $suma,
                'status' => 'Finalized'

            ]);
        });
        return redirect('/dashboard')->with('success', 'Przelew wykonany!');
    }

    public function internalTransfer(Request $request)

    {
        $id = $request->get('id');


        $accnumber = $request->get('acc_number');
        $suma = $request->get('balance');
        DB::transaction(function () use ($accnumber, $id, $suma) {



            #pobranie z konta nadawcy
            $Account = Account::findOrFail($id);

            $Account->balance -= $suma;
            $Account->save();

            //zapis do operacji po stronie nadawcy

            $Account->operation()->create([
                'type' => 'Expanse',
                'amount' => -$suma,
                'status' => 'Finalized',
            ]);


            $Account2 = Account::where('number', $accnumber)->first();

            $Account2->balance += $suma;
            $Account2->save();


            //zapis do operacji po stronie odbiorcy

            $Account2->operation()->create([
                'type' => 'Income',
                'amount' => $suma,
                'status' => 'Finalized'
            ]);
        });

        return redirect('/dashboard')->with('success', 'Przelew wykonany!');
    }

    public function externalTransfer(Request $request)

    {
        $id = $request->get('id');
        $accnumber = $request->get('acc_number');
        $title = $request->get('Title');
        $nameandadress = $request->get('DebitedNameAndAddress');

        DB::transaction(function () use ($request, $id, $accnumber, $title,$nameandadress ) {



            #pobranie z konta nadawcy
            $Account = Account::findOrFail($id);
            $User = User::findOrFail($id);
            $name = $User->name;
            $addres = $User->address;
            $nameandaddres = $name.";".$addres;
            $suma = $request->get('balance');
            $Account->balance -= $suma;
            $Account->save();


            //zapis do operacji po stronie nadawcy

            $Account->operation()->create([
                'type' => 'Expanse',
                'amount' => -$suma,
                'status' => 'Processed',
            ]);


            #stworzenie wpisu zewnetrznego


            //sprawdzamy czy mamy przelewy dla danego banku



            $nb = '10425389';
            if ($paymentStorage = PaymentStorage::where('BankNo', $nb)->first()) {
            }
            //jesli nie to tworzymy taki
            else {
                $paymentStorage = PaymentStorage::create([
                    'BankNo' => $nb,
                    'PaymentSum' => 0,
                ]);
            }


            //jesli tak to go pobieramy

            //przypisujemy mu wartosci  
            $paymentStorage->Payments()->create([
                'DebitedAccountNumber' => $Account->number,
                'DebitedNameAndAddress' => $nameandaddres,
                'CreditedAccountNumber' => $accnumber,
                'CreditedNameAndAddress' => $nameandadress,
                'Title' => $title,
                'Amount' => $suma,
            ]);

            //zwiekszamy sume 
            $paymentStorage->PaymentSum += $suma;
            $paymentStorage->save();
        });


        return redirect('/dashboard')->with('success', 'Przelew wykonany!');
    }


    public function checkTransferType(Request $request)
    {

        $request->validate([
            'balance' => 'required',
            'acc_number' => 'required',
        ]);


        $accnumber = $request->get('acc_number');

        if (app('App\Http\Controllers\GeneratorController')->validateNumber($accnumber)) {
        } else {
            throw new Exception("Wrong account number");
        }


        if (app('App\Http\Controllers\GeneratorController')->insideCheck($accnumber)) {
        } else {
            return $this->externalTransfer($request);
        }

        return $this->internalTransfer($request);
    }
}
